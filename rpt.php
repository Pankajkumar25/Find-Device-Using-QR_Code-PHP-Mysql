<?php
require_once("mysqli_connection.php");
require('fpdf.php');

$pdf=new FPDF();
$pdf->Addpage();
$pdf->setFont("Arial","",16);
$pdf->SetFillColor(976,245,458);
$pdf->Cell(0,10,"SPIC INDIA",1,1,'C',true);// First table: output all columns

if(isset($_POST['find']))
{

$where_con="";
if(isset($_REQUEST['s']))
{//echo "2nd case";
	$id_list=$_POST['l_id'];
	$id_list=str_replace('/',',',$id_list);
	//echo "id_list=$id_list";
	$where_con=" where id in($id_list)";
}
else
{
	//echo "1st case";
//echo "<br/>";


$devicetype=$_POST['devicetype'];
$department=$_POST['department'];
$date_value=$_POST['date'];
$status=$_POST['status'];
$where_con="";
if($devicetype!="all")
	$where_con="where devicetype='$devicetype'";

if($date_value!="")
{	
if($where_con!="")
$where_con .="and date='$date_value'";
else
$where_con="where date='$date_value'";
}

if($status!="all")
{	
if($where_con!="")
$where_con .="and status='$status'";
else
$where_con="where status='$status'";
}

}



$col_list="id,`qr_path`,devicetype";

$sql="select $col_list from device $where_con";

$query=mysqli_query($con,$sql);
$num=mysqli_num_rows($query);
//echo "num=$num<br/>";
$col_count=mysqli_num_fields($query);

$str="";
for($i=0;$i<$col_count;$i++)
{
	$col=mysqli_fetch_field($query);
	$col_name=$col->name;
$str.="                   ".$col_name;	
}
//$pdf->Cell(0,10,"$str",1,3,'L',true);

//echo "<br/>num=$num";
$limit=0;
$id_list=array();
$qr_list=array();
$devicetype=array();
while($data=mysqli_fetch_array($query))
{
	$id_list[$limit]=$data[0];
	$qr_list[$limit]=$data[1];
	$devicetype[$limit]=$data[2];
	
//	print_r($data[$limit]);
	$limit++;
	
//	echo"<br/>";
}
//print_r($qr_list);
//echo "lmit=$limit";
$s_value=22;


for($i=0;$i<$limit;$i++)
{



	switch($devicetype[$i])
	{
		case "desktop":
		$s1_value=70;

		$label_array=array('cpu','monitor','keyboard','mouse'); break;
		case "laptop":
		$s1_value=130;

		$label_array=array('laptop','charger'); break;
		case "all_in_one":
				$s1_value=100;
		$label_array=array('monitor','keyboard','mouse'); break;
		case "tablet":
				$s1_value=130;
		$label_array=array('tablet','charger'); break;
		case "mobile":
				$s1_value=130;
		$label_array=array('mobile','charger'); break;
		
	}



	$data=$id_list[$i]."       ".$devicetype[$i];
	$pdf->Cell(0,25," $data",1,3,'L',true);





for($img_no=1;$img_no<=count($label_array);$img_no++)
{$pdf->Image("$qr_list[$i]",$s1_value,$s_value,20);
$s1_value +=30;
}
$s_value +=25;

}

}


//exit;
$pdf->Output();
?>