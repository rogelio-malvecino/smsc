<? 
session_start(); 
include ("Functioneverwing.php");
Is_Logged_In();


include ("datasource.php");

require("connection.php");

$ItemNumber = $_POST['Itemnumber'];
$Itemname = $_POST['Itemname'];
$Itemgroup = $_POST['Groupname'];
$Itemone = $_POST['Uomone'];
$Itemtwo = $_POST['Uomtwo'];
$Itemtre = $_POST['Uomtre'];
$Itemfour = $_POST['Uomfour'];
$Itemfive = $_POST['Uomfive'];
$Itemsix = $_POST['Uomsix'];
$ItemQone = $_POST['UomQone'];
$ItemQtwo = $_POST['UomQtwo'];
$ItemQtre = $_POST['UomQtre'];
$ItemQfour = $_POST['UomQfour'];
$ItemQfive = $_POST['UomQfive'];
$ItemQsix = $_POST['UomQsix'];

$PriceidOne = $_POST['pricetenone'];
$PriceidTwo = $_POST['pricetentwo'];
$PriceidTre = $_POST['pricetentre'];
$PriceidFour = $_POST['pricetenfour'];
$PriceidFive = $_POST['pricetenfive'];
$PriceidSix = $_POST['pricetensix'];


$DescriptionOne = $_POST['descriptionone'];
$DescriptionTwo = $_POST['descriptiontwo'];
$DescriptionTre = $_POST['descriptiontre'];
$DescriptionFour = $_POST['descriptionfour'];
$DescriptionFive = $_POST['descriptionfive'];
$DescriptionSix = $_POST['descriptionsix'];

$Priceone = $_POST['priceone'];
$Pricetwo = $_POST['pricetwo'];
$Pricetre = $_POST['pricetre'];
$Pricefour = $_POST['pricefour'];
$Pricefive = $_POST['pricefive'];
$Pricesix = $_POST['pricesix'];


$author = "author";



$mResult = $mysqli->query("select * from item_list_header where Item_Number='$ItemNumber'");


$rows = mysqli_num_rows($mResult);

if($rows != 1){


$mResults = $mysqli->query("select * from item_list_uom where Item_Uom='$Itemone'");
$mResults = $mysqli->query("select * from item_list_uom where Item_Uom='$Itemtwo'");
$mResults = $mysqli->query("select * from item_list_uom where Item_Uom='$Itemtre'");
$mResults = $mysqli->query("select * from item_list_uom where Item_Uom='$Itemfour'");
$mResults = $mysqli->query("select * from item_list_uom where Item_Uom='$Itemfive'");
$mResults = $mysqli->query("select * from item_list_uom where Item_Uom='$Itemsix'");

$row = mysqli_num_rows($mResults);


if($row != 1){



$mResults = $mysqli->query("select * from item_list_detail where Item_Price_Id='$PriceidOne'");
$mResults = $mysqli->query("select * from item_list_detail where Item_Price_Id='$PriceidTwo'");
$mResults = $mysqli->query("select * from item_list_detail where Item_Price_Id='$PriceidTre'");
$mResults = $mysqli->query("select * from item_list_detail where Item_Price_Id='$PriceidFour'");
$mResults = $mysqli->query("select * from item_list_detail where Item_Price_Id='$PriceidFive'");
$mResults = $mysqli->query("select * from item_list_detail where Item_Price_Id='$PriceidSix'");


$numrows = mysqli_num_rows($mResults);


if($numrows != 1){

$mResult = $mysqli->query("insert into item_list_header(`Item_Number`,`Item_Name`,`Item_Group`,`Author`)values('$ItemNumber','$Itemname','$Itemgroup','$author');");
$mResult = $mysqli->query("insert into item_list_uom(`Item_Number`,`Item_Uom`,`Item_Qty`)values('$ItemNumber','$Itemone','$ItemQone');");
$mResult = $mysqli->query("insert into item_list_uom(`Item_Number`,`Item_Uom`,`Item_Qty`)values('$ItemNumber','$Itemtwo','$ItemQtwo');");
$mResult = $mysqli->query("insert into item_list_uom(`Item_Number`,`Item_Uom`,`Item_Qty`)values('$ItemNumber','$Itemtre','$ItemQtre');");
$mResult = $mysqli->query("insert into item_list_uom(`Item_Number`,`Item_Uom`,`Item_Qty`)values('$ItemNumber','$Itemfour','$ItemQfour');");
$mResult = $mysqli->query("insert into item_list_uom(`Item_Number`,`Item_Uom`,`Item_Qty`)values('$ItemNumber','$Itemfive','$ItemQfive');");
$mResult = $mysqli->query("insert into item_list_uom(`Item_Number`,`Item_Uom`,`Item_Qty`)values('$ItemNumber','$Itemsix','$ItemQsix');");


$mResult = $mysqli->query("insert into item_list_detail(`Item_Number`,`Item_Price_Id`,`Item_Price`)values('$ItemNumber','$PriceidOne','$Priceone')");
$mResult = $mysqli->query("insert into item_list_detail(`Item_Number`,`Item_Price_Id`,`Item_Price`)values('$ItemNumber','$PriceidTwo','$Pricetwo')");
$mResult = $mysqli->query("insert into item_list_detail(`Item_Number`,`Item_Price_Id`,`Item_Price`)values('$ItemNumber','$PriceidTre','$Pricetre')");
$mResult = $mysqli->query("insert into item_list_detail(`Item_Number`,`Item_Price_Id`,`Item_Price`)values('$ItemNumber','$PriceidFour','$Pricefour')");
$mResult = $mysqli->query("insert into item_list_detail(`Item_Number`,`Item_Price_Id`,`Item_Price`)values('$ItemNumber','$PriceidFive','$Pricefive')");
$mResult = $mysqli->query("insert into item_list_detail(`Item_Number`,`Item_Price_Id`,`Item_Price`)values('$ItemNumber','$PriceidSix','$Pricesix')");


}else{


echo $mysqli->error."  ".$_SESSION['S_MenuLocation']." Duplicate Entry : Price ID";
}




echo $_SESSION['S_MenuLocation']."&nbsp;&nbsp;Successfully Save!";
}
else{
echo $mysqli->error."  ".$_SESSION['S_MenuLocation']." Duplicate Entry : Unit of Measurement";
}

}
else{

echo $mysqli->error."  ".$_SESSION['S_MenuLocation']." Duplicate Entry : Item Number";

}
?>