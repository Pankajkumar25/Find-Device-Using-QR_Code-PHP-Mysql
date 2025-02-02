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
      <div class='panel panel-primary'>
      <div class='panel-heading'>
      <center>Issue a Device</center>
      </div>

      <div class='panel-body min_h'>
    ";
	
	echo"
	<div class='row'>
	<div class='col-md-12'>";
$obj= new mylib();
if(isset($_POST['device_type']))
{$device_type=$_POST['device_type'];

	echo"
	<div class='panel panel-info'>
	<div class='panel-heading'>
	<center><h3>$device_type<center></h3>
	</div>
	</div>
  ";
echo "<form action='data.php' method='post'>";
//echo"<label>issue department</label>";
echo "<div class='col-md-offset-0 col-md-5'>";
echo "<input type='hidden' name='device_type' value='$device_type'/>";
echo"<input type'text' name='remark' class='form-control' placeholder='Enter Your Remark'/>";
echo"</br>";
echo"</div>";
echo "<div class='col-md-offset-0 col-md-5'>";

echo "<select name='department' class='form-control'>";

$obj->db_find("department","id,department");
$num=$obj->get_num_rows();
//$data=$obj->get_row(0);
echo "<option value='select'>Select Department</option>";

for($i=0;$i<$num;$i++)
{	$data=$obj->get_row($i);
$depart_value=$data['id']."|".$data['department'];
echo "<option value='$depart_value'>$data[department]</option>";
}
echo "</select>";
echo "</div>";
echo"<input type='submit' name='issue' value='issue' class='btn btn-warning'";

echo "</div>";
echo"</form>";


$table_name="device";
if(isset($_REQUEST['a']))
	$table_name="department";
//echo "  $table_name";

	$obj->view($table_name,"*","devicetype='$device_type' and issue_status=0",30,0,"Id");
}
else
{	
echo "<div class='row'>
<label class='col-md-offset-1 col-md-3'><h3>Select Device</h3></label>
<div class='col-md-5'>";
echo "<form action='issue.php' method='post'>";	

echo "<select name='device_type' class='form-control' onchange='this.form.submit()'>";

$obj->db_find("device_type","device");
$num=$obj->get_num_rows();
//$data=$obj->get_row(0);
echo "<option value='select'>Select Device</option>";

for($i=0;$i<$num;$i++)
{	$data=$obj->get_row($i);
echo "<option value='$data[device]'>$data[device]</option>";
}
echo "</select>";

echo"</form>";
echo"</div>";
echo"</div>";

}

	echo "
	</div>
	</div>
	
	</br>

	
	
	
	
	
	
	";
	
	echo "<a href='issue.php' class='btn btn-info col-md-offset-1'>Back</a><br/>";
	
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