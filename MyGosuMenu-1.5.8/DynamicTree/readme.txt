---------
! INSTALL
---------

See: example1.html , example2.html

Warning:
- id of the menu and object variable need to be the same

----------------
! KNOWN PROBLEMS
----------------

* Opera - seems like there is no way to get the original href attribute from <a> elements,
  they are converted to absolute paths. This can be a problem in TreeBuilder. IE had the same
  problem, but a dirty hack helped to solve it.

* IE 5.0 - plugins don't work in TreeBuilder, Function.call() method is missing in its implementation.

---------
! CHANGES
---------

*** 1.5.3 ***

  - fixed a small parsing issue on Mozilla, it appeared when there was a whitespace before anchor:
    <div class="doc"> <a href="example1.html">Node 2</a></div>

*** 1.5.2 ***

  - added /tests/foldersAsLinks.html [minor changes in DynamicTree.js & .css]

*** 1.5.1 ***
  - [DynamicTreeBuilder] tmpTreeId was replaced with tree.count in actions.js, this bug could
    affect you if you had more than 20 records in a tree when starting editing.