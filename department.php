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

echo "<div class='col-md-3'>";
include("rightmenu.php");
echo "</div>";

echo "<div class='col-md-9'>";
echo"
      <div class='panel panel-info'>
      <div class='panel-heading'>
      ADD DEPARTMENT
      </div>

      <div class='panel-body min_h'>
    ";
if(isset($_REQUEST['c']))
{
	echo"Department added Succesfuly";
}
echo"
<form action='data.php' method='post'>
<div class='row'>
<label class='col-md-offset-1 col-md-3 '><h3>Department Name-</h3></label>
<div class='col-md-6'>
<input type='text' name='dp_name' class='form-control'/>
</div>
</div>
</br>
<div class='row'>
<label class='col-md-offset-1 col-md-3 '><h3>Address-</h3></label>
<div class='col-md-6'>
<input type='text' name='address' class='form-control'/>
</div>
</div>

</br>
<div class='row'>
<label class='col-md-offset-1 col-md-3 '><h3>Contact number-</h3></label>
<div class='col-md-6'>
<input type='text' name='contact_no' class='form-control'/>

</div>
</div>
</br>
<div class='row'>
<label class='col-md-offset-1 col-md-3 '><h3>Contact person name
-</h3></label>
<div class='col-md-6'>
<input type='text' name='c_name' class='form-control'/>

</div>
</div>


</br>
<div class='row'>

<div class='col-md-offset-1 col-md-6'>
<input type='submit' name='add_department' class='btn btn-success'/>
<input type='reset' name='reset' class='btn btn-success'/>
</div>
</div>


</form>



";




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