<?php  require_once("connection.php"); ?>
<html>
<head>
<?php 
require_once("mylinkfile.php");

?>
</head>
<body>
<div class="container">
<?php 
	
	echo "<br/></br/>";
		echo "<div class='row'>";
	
	echo "<div class='col-md-offset-3 col-md-6'>";
		echo "<div class='panel panel-info'>";
			echo "<div class='panel-heading'>Register";
			echo "</div>";
			echo "<div class='panel-body min_h'>";
			echo "<h5>successfully registered</h5>";
			
			if(isset($_REQUEST['q']))
			{
				$id=$_REQUEST['q'];
				//$con=mysqli_connect("localhost","root","","qr_spic");
				
				
				$sql="select * from qr where id ='$id' or qr_path like '$id'";
				
				//echo $sql."<br/>";
				$query=mysqli_query($con,$sql);
				$num=mysqli_num_rows($query);
				if($num>0)
				{
					$row_data=mysqli_fetch_row($query);
					//print_r($row_data);
					echo "
					
					<div class='form-control-group'>
           
			<br/>
<div class='form-control-group'>
            <div class='row'>
			
            <div class='col-md-3'>
            ";
			 $PNG_TEMP_DIR = dirname(__FILE__).DIRECTORY_SEPARATOR.'temp'.DIRECTORY_SEPARATOR;
    
    //html PNG location prefix
    $PNG_WEB_DIR = 'QR_CODE/';

    include "qrlib.php";    
    
    //ofcourse we need rights to create temp dir
    
    
    
    $filename = $PNG_TEMP_DIR."QR_CODE/".$row_data[5];
	//ECHO $filename;
	$filename=$row_data[5];
				   echo '<img src="'.$PNG_WEB_DIR.basename($filename).'" /><hr/>';
			
			echo"
            </div>
			
			</div>	
<br/>	
		   <div class='row'>
			<label class='col-md-offset-1 col-md-3 control-label' for='name'>Email Id</label>
            <div class='col-md-3'>
$row_data[2]
            </div>
			
			</div>
<br/>			
		<div class='form-control-group'>
            <div class='row'>
			<label class='col-md-offset-1 col-md-3 control-label' for='name'>Name</label>
            <div class='col-md-3'>
             $row_data[1]
            </div>
			
			</div>
			<br/>
<div class='form-control-group'>
            <div class='row'>
			<label class='col-md-offset-1 col-md-3 control-label' for='name'>Mobile  Number</label>
            <div class='col-md-3'>
             $row_data[3]
            </div>
			
			</div>
			<br/>
<div class='form-control-group'>
            <div class='row'>
			<label class='col-md-offset-1 col-md-3 control-label' for='name'>Number of Ticket</label>
            <div class='col-md-3'>
             $row_data[4]
            </div>
			
			</div>	
<br/>			
	";
				}
				else
				{
					echo "Not Found";
				}
			}		
			//echo "profile id=$profileid";
			
			//phpinfo(); for version detail of php
			echo "</div>";
	    echo "</div>";
	echo "</div>";
	

echo "</div>";

?>
</div>
</body>
</html>