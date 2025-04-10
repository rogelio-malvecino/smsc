----------------
! ABOUT
----------------

MyGosuMenu is a set of simple DHTML menus
Link: http://www.gosu.pl/MyGosuMenu/

This software has been released under a BSD-style licence. This essentially means free for any use,
with the one condition that the author of this software be credited in appropriate documentation.

Let me know if you find any of the menus useful. If you have any suggestions feel free to email me.
My email: cagret[at]gmail.com

You can subscribe to new releases here: 
http://freshmeat.net/projects/mygosumenu

----------------
! MENU TYPES
----------------

DropMenu1 - 1 level drop down menu (horizontal, vertical).
DropMenuX - Drop down menu with unlimited nesting (horizontal, vertical).
TreeMenu
BarMenu
XulMenu - windows like menu, unlimited nesting (horizontal, vertical)
DynamicTree & DynamicTreeBuilder

----------------
! NOTES
----------------

Some of the menus include additional file to support IE 5.0:
<script type="text/javascript" src="../ie5.js"></script>
If you want to support IE 5.0 then you have to set a proper path to file ie5.js,
if you don't wanna support this version of browser just remove that line.

--

When no doctype is specified, Internet Explorer runs in "quirks" mode.
It is for backward compatibility, and many css bugs appear. If you want
to avoid them, use a doctype, not necessary xhtml.

for example:
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
or
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">

--

IE Bug #1 (nested tables):

Example not working on IE:

<table><tr><td><table><tr><td>
    <table id="menu">....</table>
    <script>.. init menu ... </script>
</td></tr></table></td></tr></table>

Example that works on IE:

<table><tr><td><table><tr><td>
    <table id="menu">....</table>
</td></tr></table></td></tr></table>
<script>.. init menu ... </script>

Difference:
Looks like initializing the menu on IE must be done after closing some tables.

So if you are using nested tables, initialize the menu at the end of the page
or use window.onload event:

<script>
window.onload = function() {
    .. init menu ..
}
</script>