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
      <center>Total Calculation  All Device</center>
      </div>

      <div class='panel-body min_h'>
	      ";

$obj=new mylib();
$obj->db_find("device","devicetype");
$num=$obj->get_num_rows();
echo "	
<div class='col-md-4'>
<div class='panel panel-primary'>
<div class='thumbnail'>
<center><b>Total Device</b></center>
<div class='caption bg-danger'>
        <p><center><img src='pk.png' class='img-thumbnail'>Total Device=$num</center> </p>
      </div>
</div>
</div>
</div>
";



$obj=new mylib();
$obj1=new mylib();
$obj2=new mylib();

$obj->db_find("device_type","device");
$num=$obj->get_num_rows();
//$data=$obj->get_row(0);
$image_path="";
for($i=0;$i<$num;$i++)
{
	$data=$obj->get_row($i);
$temp=str_replace("_", " ",$data['device']);
$temp=ucfirst($temp);

$obj1->db_find("device","devicetype","devicetype='$data[device]'");
$total=$obj1->get_num_rows();


$obj2->db_find("device","devicetype","devicetype='$data[device]' and issue_status=1");
$issue_count=$obj2->get_num_rows();
$temp=$total-$issue_count;
$image_path="images/".$data['device'].".jpg";
echo "	
<div class='col-md-4'>
<div class='panel panel-primary'>
<div class='thumbnail'>

<center><b>$data[device]</b></center>

<div class='caption bg-danger'>
        <p><center><h3>Tolal=$total <br/>issue=$issue_count <br/>Not issue=$temp</h3></center> </p>
      </div>
</div>
</div>
</div>
";
}




//echo "total=$num";

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