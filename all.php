<?php require_once("oops_lib.php");?>

<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php
	require("linkfile.php");
  ?>
</head>
<body>

<div class="container-fluid">
  
<?php

//include("menu.php");
include("head.php");

echo "<br/>";
echo "<div class='row'>";

echo "<div class='col-md-3'>";
include("rightmenu.php");
echo "</div>";

echo "<div class='col-md-9'>";
echo"
      <div class='panel panel-info'>
      <div class='panel-heading'>
      viewall";
	  
	  
$table_name="device";
//$col_name="id,Modelno,Serialno";
$col_name="*";
if(isset($_REQUEST['a']))
	$table_name="department";
echo "  $table_name";

      echo"</div>

      <div class='panel-body min_h'>
    ";

	$obj= new mylib();
	$obj->view($table_name,"$col_name","",15,0,"qr_path","qr_path");
	
	//	$obj->view($table_name,"$col_list","$where_con",10,0,"id","issue_view.php");

	
	
echo"
	</div>
	</div>
";
echo "</div>";








//include("footer.php");


?>
</div>

</body>

</html>