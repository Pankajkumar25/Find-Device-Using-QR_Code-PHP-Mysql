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
      Click one of them option
      </div>

      <div class='panel-body min_h'>
	      ";

$obj=new mylib();
$obj->db_find("device","issue_status");
$num=$obj->get_num_rows();
echo "
<div class='row'>
<div class='col-md-offset-3 col-md-6'>
<div class='panel panel-info'>
<div class=' panel-heading'><center><label>TOTAL NUMBER OF DEVICES</lable></center></div>
<div class='panel-body'><center><h1><b>$num</b></h1></center></div>

</div>
</div>
</div>


";



$obj=new mylib();
$obj1=new mylib();

$obj->db_find("device","issue_status");
$num=$obj->get_num_rows();
//$data=$obj->get_row(0);
for($i=0;$i<$num;$i++)
{
	$data=$obj->get_row($i);
$temp=str_replace("_", " ",$data['issue_status']);
$temp=ucfirst($temp);

$obj1->db_find("device","issue_status","issue_status='$data[issue_status]'");
$num1=$obj1->get_num_rows();
echo "
	
	<div class='col-md-6'>
<div class='panel panel-info'>
<div class=' panel-heading'><center><h3><b>$data[issue_status] </b></h3></center></div>

<div class='panel-body'><br/><center><h1>$num1</h1></center> </div>

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