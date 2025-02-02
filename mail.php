<?php
ob_start();

?>
<html>
<head>
<?php require_once("mylinkfile.php");

require_once("connection.php");
?>
</head>
<body>
 <h2>Mail format</h2>
<?php	

if(isset($_POST['submit']))
{
	$from=$_POST['from_email'];
	$subject=$_POST['subject'];
	$msg=$_POST['msg'];
	$footer=$_POST['footer'];
	$sql="update mail set from_email='$from',subject='$subject',msg='$msg',footer='$footer'";
	if(mysql_query($sql))
	{
		echo "<b>successfully updated</b>";
	}
	else
	{
	echo "Error:$sql";	
	}
		
}
$sql="select * from  mail";
$query= mysql_query($sql);
$row_data= mysql_fetch_row($query);

	echo "
	<form action='mail.php' method='post'>
	<div class='form-control-group'>
            <div class='row'>
			<label class='col-md-offset-1 col-md-3 control-label' for='name'>From </label>
            <div class='col-md-3'>
 <input type='email' class='form-control' name='from_email' id='from_email' value='$row_data[1]'>
            </div>
			
			</div>
<br/>			
		<div class='form-control-group'>
            <div class='row'>
			<label class='col-md-offset-1 col-md-3 control-label' for='name'>Subject</label>
            <div class='col-md-3'>
              <input type='text' class='form-control' name='subject' id='subject' value='$row_data[2]'>
            </div>
			
			</div>
			<br/>
<div class='form-control-group'>
            <div class='row'>
			<label class='col-md-offset-1 col-md-3 control-label' for='msg'>Message</label>
            <div class='col-md-3'>
             <textarea rows=10 cols=100 name='msg'>$row_data[3]</textarea>
            </div>
			
			</div>
			<br/>
<div class='form-control-group'>
            <div class='row'>
			<label class='col-md-offset-1 col-md-3 control-label' for='name'>mail Footer</label>
            <div class='col-md-3'>
              <input type='text' class='form-control' name='footer' id='footer' value='$row_data[4]'>
            </div>
			
			</div>	
<br/>			
			<div class='form-control-group'>
            <div class='row'>
			  <div class='col-md-offset-4 col-md-3'>
			<input type='submit' value='update format' name='submit' class='btn btn-info'>
			<input type='reset'  name='reset' class='btn btn-info'>
			</div>
			</div>
			</div>
          </div>";
 
   echo "</form><hr/>";
        
    // benchmark
  //  QRtools::timeBenchmark();    
echo "</div>";
 ?>
</body>
</html> 