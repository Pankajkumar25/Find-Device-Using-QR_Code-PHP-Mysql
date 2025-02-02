<?php include("oops_lib.php"); ?>

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
      ADD DEVICE
      </div>

      <div class='panel-body min_h'>
    ";
if(isset($_REQUEST['c']))
{
	echo"Machine added Succesfuly";
}


if(isset($_POST['add']))
{
	$devicetype=$_POST['devicetype'];
	echo"
	<div class='panel panel-primary'>
	<div class='panel-heading'>
	<center><h3>$devicetype<center></h3>
	</div>
	</div>
  ";
	echo"</br>";
	
	$count=0;
	$label_array=array();
	switch($devicetype)
	{
		case "desktop":$label_array=array('cpu','monitor','keyboard','mouse'); break;
		case "laptop":$label_array=array('laptop','charger'); break;
		case "all_in_one":$label_array=array('monitor','keyboard','mouse'); break;
		case "tablet":$label_array=array('tablet','charger'); break;
		case "mobile":$label_array=array('mobile','charger'); break;
		
	}
	
	$brand_list=array('Lenovo','DELL','HP','APPLE','Asus','Acer','Huawei');
	
	echo "<form action='data.php' method='post'>";
	echo "<input type='hidden' name='devicetype' value='$devicetype'/>";
for($i=0;$i<count($label_array);$i++)
{	
echo "<br/>
<div class='row'>
		<label class='col-md-offset-1 col-md-2'><b>
		<input type='hidden' name='label_array[]' value='$label_array[$i]'/>
		
		$label_array[$i]</b></label>       
	
	
		
		<div class='col-md-3'>
		<label>SERIAL_NO</label>       
	   <input type='text' class='form-control' name='sr_no[]'placeholder=''>
        </div>
		
		
		<div class='col-md-3'>
		<label>MODEL_NO</label>       
	   <input type='text' class='form-control' name='m_no[]' placeholder=''>
        </div>

	<div class='col-md-3'>
		<label>BRAND</label>       
	   <select class='form-control' name='brand[]'placeholder=''>
        ";
		for($j=0;$j<count($brand_list);$j++)
		echo"<option value='$brand_list[$j]'>$brand_list[$j]</option>";
		echo "</select>
		</div>";
	
	

		echo "</div>";
}	
	
	echo "
		<div class='col-md-3'>

	   <input type='submit' class='btn btn-info' name='add_device' />
	   <a href=''><spam class='btn btn-info'>Back</spam></a><br/>
        </div>	
	</form>";
	
}
else
{
echo "<div class='row'>
<label class='col-md-offset-1 col-md-3'><h3>Select Device</h3></label>
<div class='col-md-4'>";
echo "<form action='add.php' method='post'>";
echo "<select name='devicetype' class='form-control'>";
$obj=new mylib();
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

echo "</div>
<div class='col-md-3'><input type='submit' value='Add' name='add' class='btn btn-info'/></div>
</div>";

echo"</form>";
}

/*echo"
<form action='data.php' method='post'>
<div class='row'>
<label class='col-md-3 '>MODEL NO-</label>
<div class='col-md-9'>
<input type='text' name='modelno' class='form-control'/>
</div>
</div>
</br>
<div class='row'>
<label class='col-md-3 '>SERIAL NO-</label>
<div class='col-md-9'>
<input type='text' name='serialno' class='form-control'/>
</div>
</div>

</br>
<div class='row'>
<label class='col-md-3 '>DEVICE TYPE-</label>
<div class='col-md-9'>
";

echo "<select name='devicetype' class='form-control'>";
$obj=new mylib();
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

echo "</div>
</div>
</br>
<div class='row'>
<label class='col-md-3 '>WORKING/NOT WORKING-</label>
<div class='col-md-9'>
<select name='status' class='form-control'>
<option value='working'>working</option>
<option value='not_working'>not working</option>
</select>

</div>
</div>


</br>
<div class='row'>

<div class='col-md-9'>
<input type='submit' name='add_device' class='btn btn-success'/>
<input type='reset' name='reset' class='btn btn-success'/>
</div>
</div>


</form>



";
*/



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