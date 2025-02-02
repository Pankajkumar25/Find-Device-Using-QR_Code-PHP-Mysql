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
      QR CODE GENRATE
      </div>

      <div class='panel-body min_h'>
     
	 ";
	 
echo "<form action='rpt.php' method='post'>";

echo "<div class='row'>
<label class='col-md-offset-1 col-md-3'><h3>Select Device</h3></label>
<div class='col-md-5'>";
echo "<select name='devicetype' class='form-control'>";
$obj=new mylib();
echo "<option value='all'>Select Device</option>"; 
$obj->db_find("device_type","device");
$num=$obj->get_num_rows();
//$data=$obj->get_row(0);
for($i=0;$i<$num;$i++)
{	$data=$obj->get_row($i);
$temp=str_replace("_", " ",$data['device']);
$temp=ucfirst($temp);
echo "<option value='$data[device]'>$temp</option>";
}
echo "</select>";
echo "</div>";
echo "</div>";
echo "<br/>";


echo "<div class='row'>
<label class='col-md-offset-1 col-md-3'><h3>Select Department</h3></label>
<div class='col-md-5'>";
echo "<select name='department' class='form-control'>";
echo "<option value='all'>Select Department</option>"; 
$obj=new mylib();
$obj->db_find("department","id,department");
$num=$obj->get_num_rows();
//$data=$obj->get_row(0);
for($i=0;$i<$num;$i++)
{	$data=$obj->get_row($i);
$temp=str_replace("_", " ",$data['department']);
$temp=ucfirst($temp);
echo "<option value='$data[department]'>$temp</option>";
}
echo "</select>";
echo "</div>";
echo "</div>";
echo "<br/>";

echo "<div class='row'>
<label class='col-md-offset-1 col-md-3'><h3>Status</h3></label>
<div class='col-md-5'>";
echo "<select name='status' class='form-control'>";
echo "<option value='all'>Select Status</option>"; 
echo "<option value='1'>working</option>"; 
echo "<option value='0'>non working</option>"; 
echo "</select>";
echo "</div>";
echo "</div>";
echo "<br/>";

echo "<div class='row'>
<label class='col-md-offset-1 col-md-3'><h3>Date</h3></label>
<div class='col-md-5'>";
echo "<input type='date' name='date' class='form-control'>";
echo "</div>";
echo "</div>";
echo "<br/>";

echo "<div class='row'>
<div class='col-md-offset-1 col-md-5'>";
echo "<input type='submit' name='find' value='Print QR CODE' class='btn btn-info'>";
echo "</div>";
echo "</div>";
echo "<br/>";

echo "</form>";
/*

echo "
<div class='row'>
<label class='col-md-offset-1 col-md-2'>Select Device</label>
<div class='col-md-4'>";
echo "<select name='devicetype' class='form-control'>";
$obj=new mylib();
$obj->db_find("department","id,department");
$num=$obj->get_num_rows();
//$data=$obj->get_row(0);
for($i=0;$i<$num;$i++)
{	$data=$obj->get_row($i);
$temp=str_replace("_", " ",$data['department']);
$temp=ucfirst($temp);
echo "<option value='$data[department]'>$temp</option>";
}
echo "</select>";

echo "</div>";
/*
echo"<div class='row'>
	<div class='col-md-3'>
</br>
</br>
</br>
<input type='checkbox' name='working' value='working' checked/> working 
</br>
<input type='checkbox' name='non_working' value='non_working'/> non working 
</div>
</div>
"
;
*/



echo "</div>";








//include("footer.php");


?>
</div>

</body>

</html>