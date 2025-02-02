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

      <div class='panel-body min_h'> ";
        
    echo"<form action='' method='post' >
       
		<div class='col-md-3'>
		<label>CPU</label>       
	   <input type='text' class='form-control' placeholder=''>
        </div>
		
		
		<div class='col-md-3'>
		<label>SERIAL_NO</label>       
	   <input type='text' class='form-control' placeholder=''>
        </div>
		
		
		<div class='col-md-3'>
		<label>MODEL_NO</label>       
	   <input type='text' class='form-control' placeholder=''>
        </div>
		
    </form>";

echo "</div>";








//include("footer.php");


?>
</div>

</body>

</html>