<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php
	require("mysqli_connection.php");
	include("oops_lib.php");
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


echo "<div class='col-md-9'>";
echo"
      <div class='panel panel-info'>
      <div class='panel-heading'>
      Click one of them option
      </div>

      <div class='panel-body min_h'>
     ";
    
	
	

echo "<form action='data1.php' method='post'>
<div class='row'>
<div class='col-md-3'>Select device type</div>
<div class='col-md-5'>
<select name='a1' id='a2' class='form-control'>
<option value=''>---Select the options----</option>
<option value='desktop'>desktop</option>
<option value='laptop'>laptop</option>
<option value='all_in_one'>all_in_one</option>
<option value='tablet'>tablet</option>
</select>
</div>
<div class='col-md-2'>
<input type='submit' value='Proceed' name='data3' class='btn btn-info'/>
</div>
</div>
</form>



";


 if(isset($_POST['data3']))
{	
	echo "</hr>";
	echo "</br>";
	echo "<a href='main.php'>Back</a>";
	echo "<br/>";
	$id=$_POST['id'];
	//echo "case 2<br/>";
	//echo "id=$id";
	$query="select * from stored where id=$id";
	//echo "<br/>$query";
	$query_result=mysqli_query($con,$query);
		$row_data=mysqli_fetch_row($query_result);
		//echo "<br/>$row_data[1]<br/>$row_data[2]";
		//print_r($row_data);	
		echo "<table class='table'>";
		echo "<tr><th>Empid</th><td>$row_data[0]</td></tr>";
		echo "<tr><th>Empname</th><td>$row_data[1]</td></tr>";
		echo "<tr><th>Empsalary</th><td>$row_data[2]</td></tr>";
		//echo "<tr><th>Empimage</th><td><img src='$row_data[3]'/></td></tr>";
		echo "</table>";
		
}
else
{
	
echo "
<form action='main.php' method='post'>
<div class='row'>
<div class='col-md-3'>Empid</div>
<div class='col-md-5'>";
echo "<select name='id' class='form-control'>";
$sql="select id from stored";
$query=mysqli_query($con,$sql);
//$num=mysqli_num_rows($query);
while($row_data=mysqli_fetch_array($query))
{
	echo "<option value='$row_data[0]'>$row_data[0]</option>";
	
}



echo "</select>$num";



//<input type='text' name='empid' class='form-control' />
echo "</div>
<div class='col-md-2'>
<input type='submit' value='Find' name='data3' class='btn btn-info'/>
</div>
</div>
</form>

<form action='data2.php' method='post'>
<div class='col-md-12'>
<input type='submit' name='data2'  class='btn btn-info' value='viewall'/>	
</div>
</form>


";
}

echo"
	</div>
	</div>
";

echo "</div>";


echo "<div class='col-md-3'>";
include("rightmenu.php");
echo "</div>";

echo "<div class='col-md-3'>";
include("adspanel.php");
echo "</div>";


echo "</div>";


include("footer.php");


?>
</div>

</body>

</html>