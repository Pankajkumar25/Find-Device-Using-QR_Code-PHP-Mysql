<?php
ob_start();

?>
<html>
<head>
<?php 
require_once("mylinkfile.php");
require_once("connection.php");

?>


</head>
<body>
 
<?php    

    
	echo "<div class='container'>";
echo "<h3>Report</h3>";
$sql="select * from qr where email_id!=''";
$query=mysql_query($sql);
$num=mysql_num_rows($query);
echo "$num Record Found<br/>";
echo "<table class='table'>";
$sno=1;
echo "<tr><th>Sno</th><th>User Name</th><th>Email Id</th><th>Mobile  Number</th><th>Number of Ticket</th></tr>";
while($row_data=mysql_fetch_array($query))
{
	echo "<tr><td>$sno</td><td>$row_data[1]</td><td>$row_data[2]</td><td>$row_data[3]</td><td>$row_data[4]</td></tr>";
$sno++;
}
echo "</table>";
echo "</div>";
 ?>

</body>
</html> 