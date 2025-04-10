<?php
/*
 * DO NOT REMOVE THIS NOTICE
 *
 * PROJECT:   MyGosuMenu
 * VERSION:   1.5.5
 * COPYRIGHT: (c) 2003-2009 Cezary Tomczak
 * LINK:      http://www.gosu.pl/MyGosuMenu/
 * LICENSE:   BSD (revised)
 */

/**
* Note: this function is called recursively
* @param array &$a
* @param string $id (optional)
* @return string
*/
function generateTreeMenu(&$a, $id = null) {
    $s = '<ul';
    if ($id)
        $s .= ' id="'.$id.'" class="tree-menu"';
    $s .= '>';
    foreach ($a as $k => $v) {
        if (is_array($v)) {
            $s .= '<li><a href="javascript:void(0)">'.$k.'</a>';
            $s .= generateTreeMenu($a[$k]);
            $s .= '</li>';
        } else {
            $s .= '<li><a href="'.$v.'">'.$k.'</a></li>';
        }
    }
    $s .= '</ul>';
    return $s;
}

$menu = array(
    'Products' => array(
        'Product One' => '#',
        'Product Two' => array(
            'Overview' => '#',
            'Features' => '#',
            'Requirements' => '#',
            'Flash Demos' => '#'
        ),
        'Product Three' => array(
            'Overview' => '#',
            'Features' => '#',
            'Requirements' => '#',
            'Screenshots' => '#',
            'Flash Demos' => '#',
            'Live Demo' => array(
                'Create Account' => '#',
                'Test Drive' => array(
                    'Test One' => '#',
                    'Test Two' => '#',
                    'Test Three' => '#'
                )
            )
        ),
        'Product Four' => array(
            'Overview' => '#',
            'Features' => '#',
            'Requirements' => '#'
        ),
        'Product Five' => '#'
    ),
    'Downloads' => array(
        '30-day Demo Key' => '#',
        'Product One Download' => array(
            'Windows Download' => '#',
            'Solaris Download' => '#',
            'Linux Download' => '#'
        ),
        'Product Two Download' => array(
            'Linux Download' => '#'
        )
    ),
    'Support' => array(
        'E-mail Support' => '#'
    ),
    'Partners' => array(
        'Partner Benefits' => '#',
        'Partner Application' => array(
            'Application One' => '#',
            'Application Two' => '#',
            'Application Three' => '#',
            'Application Four' => '#',
            'Application Five' => '#',
            'Application Six' => '#',
            'Application Seven' => '#',
            'Application Eight' => '#'
        ),
        'Partner Listing' => '#'
    ),
    'Customers' => array(
        'Customer One' => '#',
        'Customer Two' => '#',
        'Customer Three' => '#'
    ),
    'About Us' => array(
        'Executive Team' => '#',
        'Investors' => '#',
        'Career Opportunities' => '#',
        'Press Center' => array(
            'Product Information' => '#'
        ),
        'Success Stories' => '#',
        'Contact Us' => '#'
    )
);

?>

<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
	<title>Tree Menu - PHP Generator - Example</title>
    <link rel="stylesheet" type="text/css" href="TreeMenu.css">
    <script type="text/javascript" src="TreeMenu.js"></script>
	<style type="text/css">
	h1 { font-size: 24px; }
	body { font-family: tahoma; font-size: 13px; }
	</style>
</head>
<body>

<h1>Tree Menu - PHP Generator - Example</h1>

<p>
	<b>Project</b>: <a href="http://www.gosu.pl/MyGosuMenu/">MyGosuMenu</a> <br />
    <b>Menu type</b>: TreeMenu<br />
</p>

<script type="text/javascript">
window.onload = function() {
    new TreeMenu("menu1");
}
</script>

<?php echo generateTreeMenu($menu, 'menu1'); ?>

</body>
</html>