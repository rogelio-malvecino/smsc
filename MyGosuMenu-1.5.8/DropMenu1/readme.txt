/*
 * DO NOT REMOVE THIS NOTICE
 *
 * PROJECT:   MyGosuMenu
 * VERSION:   1.5.5
 * COPYRIGHT: (c) 2003-2009 Cezary Tomczak
 * LINK:      http://www.gosu.pl/MyGosuMenu/
 * LICENSE:   BSD (revised)
 */

----------------
! INSTALL
----------------

1) include .css file
2) include .js file
3) put html structure
4) initialize menu
   
Example of initializing:
  var menu = new DropMenu1("id_of_the_menu");
  menu.init();

Example of initializing and setting additional stuff:
  var dm1 = new DropMenu1("dm1");
  dm1.type = "horizontal";
  dm1.delay.show = 0;
  dm1.delay.hide = 100;
  dm1.position.top = -5;
  dm1.position.left = 0;
  dm1.init();

----------------
! FEATURES
----------------

- horizontal or vertical menu
- can be positioned statically or absolutely
- delay for showing/hiding menu (can be turned off by setting to 0)
- position of submenus can be changed, so they can for example overflow parent elements
- on the same page there can be many menus created
- seperated into 3 layers: behaviour(javascript), structure(html), presentation(css)
- search engine friendly
- free for any use (BSD license) 

----------------
! COMPATIBILITY
----------------

Tested on: IE, Mozilla, Opera, Netscape, Firefox, Safari

Known CSS problems:
* Safari: setting margin > 0 for BODY element causes some positioning problems. Sections in the menu
  will be placed a few pixels away from the default place. The menu still works and is usable. To avoid
  these problems set "margin: 0;" for BODY element.
* IE: removing doctype causes that IE enables Backward Compatibility Mode and some CSS bugs can appear.
  Then you will need to edit .css file and make some fixes.

----------------
! CHANGELOG
----------------

*** 1.0.8 ***

  - added support for IE 5.0/5.5

*** 1.0.7 ***

  - fixed a bug that appeared on IE 5.5
  - [js] modified some code
  - [css] removed 2 fixes at the end of file

*** 1.0.6 ***
  
  - Fixed Safari word-spacing bug
  - Fixed Opera margin bug
  - Many other bugs fixed, by using table.
  - Using table again, because while trying to do it completely CSS driven without using tables,
    I have encountered so many incompatibilites between browsers, so many css bugs that it became nearly
    impossible to do it.

*** 1.0.5 ***

  - the menu has been completely rewritten, a few bugs fixed, new features added !!

*** 1.0.4 ***

  - [menu.css] fixed a minor Opera 7.2.x CSS bug (removed "width: 100%" from #menu .top)
  - [menu.css] some other changes
  - [menu.js] done some optimization

*** 1.0.3 ***

  - fixed a bug on Mozilla (z-index issue)
    2 files were modified:
    * menu.js after line 29 added: "document.getElementById(section).style.zIndex = -1"
    * menu.css added "z-index: -1;" to #menu div.section
  - in menu.css , changed position from "static" to "relative" in #menu div.box
    (probably it caused the menu not working on Safari browser)

*** 1.0.2 ***

  - fixed a bug where the menu disappeared when the mouse was not over a link, but was over the menu 
  - fixed a few minor bugs that affected the construction of the left menu 
  - added an example of the left menu 
  - removed debug tools 
  - size of menu.js reduced from 5kB to 3kB 

*** 1.0.1 ***

  - an easier way to put boxes in menu.html

*** 1.0.0 ***

  - first release !