/* This script and many more are available free online at
The JavaScript Source :: http://javascript.internet.com
Created by: Joost de Valk :: http://www.joostdevalk.nl/ */

/*
Table sorting script, taken from http://www.kryogenix.org/code/browser/sorttable/ .
Distributed under the MIT license: http://www.kryogenix.org/code/browser/licence.html .

Adaptation by Joost de Valk (http://www.joostdevalk.nl/) to add alternating row classes as well.

Copyright (c) 1997-2006 Stuart Langridge, Joost de Valk.
*/

/* Change these values */
var image_path = "";
// var image_path = "/code/sortable_table/";
var image_up = "arrow-up.gif";
var image_down = "arrow-down.gif";
var image_none = "arrow-none.gif";

/* Don't change anything below this unless you know what you're doing */
addEvent(window, "load", sortables_init);

var SORT_COLUMN_INDEX;

function sortables_init() {
  // Find all tables with class sortable and make them sortable
  if (!document.getElementsByTagName) return;
  tbls = document.getElementsByTagName("table");
  for (ti=0;ti<tbls.length;ti++) {
    thisTbl = tbls[ti];
    if (((' '+thisTbl.className+' ').indexOf("sortable") != -1) && (thisTbl.id)) {
      ts_makeSortable(thisTbl);
    }
  }
}

function ts_makeSortable(table) {
  if (table.rows && table.rows.length > 0) {
    var firstRow = table.rows[0];
  }
  if (!firstRow) return;

  // We have a first row: assume it's the header, and make its contents clickable links
  for (var i=0;i<firstRow.cells.length;i++) {
    var cell = firstRow.cells[i];
    var txt = ts_getInnerText(cell);
    if (cell.className != "unsortable" && cell.className.indexOf("unsortable") == -1) {
    }
  }
  alternate(table);
}

function ts_getInnerText(el) {
  if (typeof el == "string") return el;
  if (typeof el == "undefined") { return el };
  if (el.innerText) return el.innerText;  //Not needed but it is faster
  var str = "";
  var cs = el.childNodes;
  var l = cs.length;
  for (var i = 0; i < l; i++) {
    switch (cs[i].nodeType) {
      case 1: // element_node
        str += ts_getInnerText(cs[i]);
        break;
      case 3: // text_node
        str += cs[i].nodeValue;
        break;
    }
  }
  return str;
}

function ts_resortTable(lnk) {
  // get the span
  var span;
  for (var ci=0;ci<lnk.childNodes.length;ci++) {
    if (lnk.childNodes[ci].tagName && lnk.childNodes[ci].tagName.toLowerCase() == 'span') span = lnk.childNodes[ci];
  }
  var spantext = ts_getInnerText(span);
  var td = lnk.parentNode;
  var column = td.cellIndex;
  var table = getParent(td,'TABLE');

  // Work out a type for the column
  if (table.rows.length <= 1) return;
  var itm = ts_getInnerText(table.rows[1].cells[column]);
  sortfn = ts_sort_caseinsensitive;
  if (itm.match(/^\d\d[\/-]\d\d[\/-]\d\d\d\d$/)) sortfn = ts_sort_date;
  if (itm.match(/^\d\d[\/-]\d\d[\/-]\d\d$/)) sortfn = ts_sort_date;
  if (itm.match(/^[�$�]/)) sortfn = ts_sort_currency;
  if (itm.match(/^[\d\.]+$/)) sortfn = ts_sort_numeric;
  SORT_COLUMN_INDEX = column;
  var firstRow = new Array();
  var newRows = new Array();
  for (i=0;i<table.rows[0].length;i++) {
    firstRow[i] = table.rows[0][i];
  }
  for (j=1;j<table.rows.length;j++) {
    newRows[j-1] = table.rows[j];
  }

  newRows.sort(sortfn);

  if (span.getAttribute("sortdir") == 'down') {
    ARROW = '  <img src="'+ image_path + image_up + '" alt="?"/>';
    newRows.reverse();
    span.setAttribute('sortdir','up');
  } else {
    ARROW = '  <img src="'+ image_path + image_down + '" alt="?"/>';
    span.setAttribute('sortdir','down');
  }

  // We appendChild rows that already exist to the tbody, so it moves them rather than creating new ones
  // don't do sortbottom rows
  for (i=0; i<newRows.length; i++) {
    if (!newRows[i].className || (newRows[i].className && (newRows[i].className.indexOf('sortbottom') == -1))) {
      table.tBodies[0].appendChild(newRows[i]);
    }
  }
  // do sortbottom rows only
  for (i=0; i<newRows.length; i++) {
    if (newRows[i].className && (newRows[i].className.indexOf('sortbottom') != -1))
      table.tBodies[0].appendChild(newRows[i]);
  }

  // Delete any other arrows there may be showing
  var allspans = document.getElementsByTagName("span");
  for (var ci=0;ci<allspans.length;ci++) {
    if (allspans[ci].className == 'sortarrow') {
      if (getParent(allspans[ci],"table") == getParent(lnk,"table")) { // in the same table as us?
        allspans[ci].innerHTML = '  <img src="'+ image_path + image_none + '" alt="?"/>';
      }
    }
  }

  span.innerHTML = ARROW;
  alternate(table);
}

function getParent(el, pTagName) {
  if (el == null) {
    return null;
  } else if (el.nodeType == 1 && el.tagName.toLowerCase() == pTagName.toLowerCase()) {    // Gecko bug, supposed to be uppercase
    return el;
  } else {
    return getParent(el.parentNode, pTagName);
  }
}
function ts_sort_date(a,b) {
  aa = ts_getInnerText(a.cells[SORT_COLUMN_INDEX]);
  bb = ts_getInnerText(b.cells[SORT_COLUMN_INDEX]);
  if (aa.length == 10) {
    dt1 = aa.substr(6,4)+aa.substr(3,2)+aa.substr(0,2);
  } else {
    yr = aa.substr(6,2);
    if (parseInt(yr) < 50) {
      yr = '20'+yr;
    } else {
      yr = '19'+yr;
    }
    dt1 = yr+aa.substr(3,2)+aa.substr(0,2);
  }
  if (bb.length == 10) {
    dt2 = bb.substr(6,4)+bb.substr(3,2)+bb.substr(0,2);
  } else {
    yr = bb.substr(6,2);
    if (parseInt(yr) < 50) {
      yr = '20'+yr;
    } else {
      yr = '19'+yr;
    }
    dt2 = yr+bb.substr(3,2)+bb.substr(0,2);
  }
  if (dt1==dt2) {
    return 0;
  }
  if (dt1<dt2) {
    return -1;
  }
  return 1;
}

function ts_sort_currency(a,b) {
  aa = ts_getInnerText(a.cells[SORT_COLUMN_INDEX]).replace(/[^0-9.]/g,'');
  bb = ts_getInnerText(b.cells[SORT_COLUMN_INDEX]).replace(/[^0-9.]/g,'');
  return parseFloat(aa) - parseFloat(bb);
}

function ts_sort_numeric(a,b) {
  aa = parseFloat(ts_getInnerText(a.cells[SORT_COLUMN_INDEX]));
  if (isNaN(aa)) {
    aa = 0;
  }
  bb = parseFloat(ts_getInnerText(b.cells[SORT_COLUMN_INDEX]));
  if (isNaN(bb)) {
    bb = 0;
  }
  return aa-bb;
}

function ts_sort_caseinsensitive(a,b) {
  aa = ts_getInnerText(a.cells[SORT_COLUMN_INDEX]).toLowerCase();
  bb = ts_getInnerText(b.cells[SORT_COLUMN_INDEX]).toLowerCase();
  if (aa==bb) {
    return 0;
  }
  if (aa<bb) {
    return -1;
  }
  return 1;
}

function ts_sort_default(a,b) {
  aa = ts_getInnerText(a.cells[SORT_COLUMN_INDEX]);
  bb = ts_getInnerText(b.cells[SORT_COLUMN_INDEX]);
  if (aa==bb) {
    return 0;
  }
  if (aa<bb) {
    return -1;
  }
  return 1;
}

function addEvent(elm, evType, fn, useCapture) {
// addEvent and removeEvent
// cross-browser event handling for IE5+, NS6 and Mozilla
// By Scott Andrew

  if (elm.addEventListener){
    elm.addEventListener(evType, fn, useCapture);
    return true;
  } else if (elm.attachEvent){
    var r = elm.attachEvent("on"+evType, fn);
    return r;
  } else {
    alert("Handler could not be removed");
  }
}

function replace(s, t, u) {
  /*
  **  Replace a token in a string
  **    s  string to be processed
  **    t  token to be found and removed
  **    u  token to be inserted
  **  returns new String
  */
  i = s.indexOf(t);
  r = "";
  if (i == -1) return s;
  r += s.substring(0,i) + u;
  if ( i + t.length < s.length)
    r += replace(s.substring(i + t.length, s.length), t, u);
  return r;
}

function alternate(table) {
  // Take object table and get all it's tbodies.
  var tableBodies = table.getElementsByTagName("tbody");
  // Loop through these tbodies
  for (var i = 0; i < tableBodies.length; i++) {
    // Take the tbody, and get all it's rows
    var tableRows = tableBodies[i].getElementsByTagName("tr");
    // Loop through these rows
    // Start at 1 because we want to leave the heading row untouched
    for (var j = 1; j < tableRows.length; j++) {
      // Check if j is even, and apply classes for both possible results
      if ( (j % 2) == 0  ) {
        if (tableRows[j].className == 'odd' || !(tableRows[j].className.indexOf('odd') == -1) ) {
          tableRows[j].className = replace(tableRows[j].className, 'odd', 'even');
        } else {
          tableRows[j].className += " even";
        }
      } else {
        if (tableRows[j].className == 'even' || !(tableRows[j].className.indexOf('even') == -1) ) {
          tableRows[j].className = replace(tableRows[j].className, 'even', 'odd');
        }
        tableRows[j].className += " odd";
      }
    }
  }
}


