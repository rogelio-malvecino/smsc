/*
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

Html structure is:

- dmx
    - item1
    - section
        - item2
        - item2
        - item2
        - section
            - item2
            - item2
            - item2
        - item2
    - item1
    - section
        - item2
        - item2
    - item1

Example of initializing:
  var menu = new DropMenuX("id_of_the_menu");
  menu.init();

Example of initializing and setting additional stuff:
  var dmx = new DropMenuX("menu1");
  dmx.type = "horizontal";
  dmx.delay.show = 0;
  dmx.delay.hide = 400;
  dmx.position.level1.top = 0;
  dmx.position.level1.left = 0;
  dmx.position.levelX.top = 0;
  dmx.position.levelX.left = 0;
  dmx.fixIeSelectBoxBug = true;
  dmx.zIndex.visible = 500;
  dmx.zIndex.hidden = -1;
  dmx.init();

----------------
! FEATURES
----------------

- horizontal or vertical menu
- unlimited nesting
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
* IE: IMG tags (arrows) could be removed from html structure and right aligned background could be 
  set in .arrow class, but .. Internet Explorer has a bug - it doesn't cache CSS images. So if you have 20 arrows in menu
  ie will load them 20 times on each page request ! That can be annoying for users with slow connection, it also
  increases your bandwidth unnecessarily.

----------------
! CHANGELOG
----------------

*** 1.1.6 ***

  - fixed IE 6 selectbox bug

*** 1.1.5 ***

  - added support for IE 5.0 and IE 5.5

*** 1.1.4 ***

  - menu has been completely rewritten, some bugs fixed, new features added.
    The code is based on DropMenu1.

*** 1.1.3 ***

  - [menu.js] fixed a bug that appeared on IE browser when doctype was "HTML 4.01 Transitional"

*** 1.1.2 ***

  - [menu.js] fixed a bug that crashed positioning when doctype was specified (only GECKO browsers)
  - [menu.js] fixed an IE bug that appeared when doctype was specified (backward compatibility mode activated)

*** 1.1.1 ***

  - [menu.css] fixed a minor Opera 7.2.x CSS bug (removed "width: 100%" from #menu .top)
    

*** 1.1.0 ***

  - first release of tree menu