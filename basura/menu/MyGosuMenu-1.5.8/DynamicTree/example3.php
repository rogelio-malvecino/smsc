<?php

ini_set('error_reporting', -1);
ini_set('display_errors', 1);

$link = mysql_connect('localhost', 'root', 'toor');
mysql_select_db('test', $link);

$sql = "
CREATE TABLE IF NOT EXISTS tree (id int not null primary key, name varchar(50), id_par int);
REPLACE INTO tree VALUES (1, 'Doc 1', null);
REPLACE INTO tree VALUES (2, 'Doc 2', null);
REPLACE INTO tree VALUES (3, 'Doc 3', null);
REPLACE INTO tree VALUES (4, 'Doc 4', null);
REPLACE INTO tree VALUES (5, 'Doc 1.1', 1);
REPLACE INTO tree VALUES (6, 'Doc 2.1', 2);
REPLACE INTO tree VALUES (7, 'Doc 2.2', 2);
REPLACE INTO tree VALUES (8, 'Doc 2.2.1', 7);
";

$queries = explode(';', $sql);
foreach ($queries as $query) {
	mysql_query($query, $link);
}

function tree_html($id = null)
{
    $ret = '';

	if (null == $id) $q_id = 'id_par IS NULL';
	else $q_id = 'id_par = '.(int)$id;

	$result = mysql_query('SELECT * FROM tree WHERE '.$q_id);
	$childs = array();
	while ($row = mysql_fetch_assoc($result)) {
		$childs[] = $row;
	}

    foreach ($childs as $row)
    {
        $row['name'] = str_replace(array("'", '"'), '', $row['name']);
        $row['name'] = htmlspecialchars($row['name']);

        $nest = tree_html($row['id']);
        if ($nest) {
            $ret .= '<div class="folder" id="tree-'.$row['id'].'">';
            $ret .= '<a href="javascript:void(0)">'.$row['name'].'</a>';
            $ret .= $nest;
            $ret .= '</div>';
        } else {
            $ret .= '<div class="doc" id="tree-'.$row['id'].'">';
            $ret .= '<a href="">'.$row['name'].'</a>';
            $ret .= '</div>';
        }
    }

    return $ret;
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta http-equiv="Content-Language" content="en" />
    <title>Dynamic Tree - Example 3 - php/mysql generated</title>
    <link rel="stylesheet" type="text/css" href="DynamicTree.css" />
    <script type="text/javascript" src="DynamicTree.js"></script>
    <style type="text/css">
	h1 { font-size: 24px; }
    body { font-size: 13px; font-family: tahoma; }
    </style>
</head>
<body>

<h1>Dynamic Tree - Example 3 - php/mysql generated</h1>

<div class="DynamicTree">
	<div class="top">Tree View</div>
	<div class="wrap" id="tree">
		<?php echo tree_html(); ?>
	</div>
</div>

<script type="text/javascript">
var tree = new DynamicTree("tree");
tree.init();
</script>

<br />
<div><b>Project:</b> <a href="http://www.gosu.pl/MyGosuMenu/">mygosuMenu</a></div>
<div><b>Menu type:</b> DynamicTree</div>

<p>
	<b>Features:</b> <br />
	- Dynamically editable in browser (see example 2) <br />
	- Export the structure of the tree to Html, Php or Sql <br />
	- State of the menu is saved in cookie <br />
	- Unlimited nesting <br />
	- Links are visible to search engines <br />
	- Accessible for user agents with javascript disabled (see /tests/test2.html) <br />
	- Object Oriented code, so you can create many menus on the same page <br />
	- Free for any use (BSD license)
</p>
<p>
	<b>Compatibility:</b><br />
	Tested on: IE 5.0/5.5/6.0, Mozilla 1.4/1.7, Opera 7.11/7.23/7.52, Netscape 7.11, Firefox 0.7/0.8/0.9, Safari 1.2
</p>

</body>