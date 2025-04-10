<html>
<head>

<script type="text/javascript" src="jquery/jquery-1.4.2.min.js"></script>
<script type="text/javascript"> 
$(document).ready(function(){
  $(".flip").click(function(){
    $(".panel").slideDown("slow");
  });
});
</script>
<style type="text/css"> 
div.panel,p.flip
{
margin:0px;
padding:5px;
text-align:center;
background:#e5eecc;
border:solid 1px #c3c3c3;
}
div.panel
{
height:120px;
display:none;
}
</style>
</head>
 
<body>




 
<div class="panel">
<input type="text" name="">
<input type="text" name="">
</div>
 
<p class="flip">Show Panel</p>
 
</body>
</html>
