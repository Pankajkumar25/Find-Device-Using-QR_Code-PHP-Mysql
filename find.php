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

      <div class='panel-body min_h'>";


if(isset($_POST['find']))

{

  $obj=new mylib();

	$id=$_POST['id'];
//	echo "id=$id";
	//exit;
  echo "<div class='row'>";
  echo "<div class='col-md-5'>";
$status=$obj->db_find("device","*","id=$id");

if($status)
{
	$num_rows=$obj->get_num_rows();
//	echo "$num_rows";
	echo "<a href='find.php'  class='btn btn-info'>BACK</a><br/>";
	
	$row_value=$obj->get_row(0);

  echo "<table class='table' border=1>";
  //echo"<center><h1>FIND TABLE</h1></center>";
foreach($row_value as $ckey=>$val)
{
  if($ckey=="qr_path")
  {
    echo "<tr  ><th  class='bg-primary'>$ckey</th><td ><img src='$val' width=100/></td></tr>";

  }
  else
  echo "<tr  ><th class='bg-primary'>$ckey</th><td >$val</td></tr>";

}	

echo"</table>";
}
else{
  echo "not found";
}


echo "<div class='col-md-6'>";
$status=$obj->db_find("issue","*","device_id =$id");
$num_rows=$obj->get_num_rows();
//echo "num_rows=$num_rows";
echo "Issue status<br/>";
echo "<div class='col-md-4'>";


  if($num_rows>0)
  {
$status=$obj->view("issue","*","device_id=$id order by date desc",10,0);

  }
else
{
echo "no issue data found";

}




echo "</div>";

echo "</div>";
echo "</div>";






}
else
{





      echo"<form action='find.php' method='post' enctype='multipart/form-data' >

      <div class='row'>
      <label class='col-md-offset-1 col-md-3'><h3>ENTER YOUR ID NO:</h3> </label>
      <div class='col-md-5'>
      <input type='text' name='id' class='form-control'/>
      </div>
      </div>
      <br/>
      
      <div class='row'>
      <div class='col-md-offset-5 col-md-4'>
      <input type='submit' name='find' value='FIND' class='btn btn-info'/>
      <input type='reset' value='RESET' class='btn btn-info'/>
      </div>
      
      </form>    ";

}
echo"	</div></div>";


echo "</div>";
echo "</div>";

?>
</div>

</body>

</html>