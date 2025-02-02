<?php
require_once("oops_lib.php");
$obj=new mylib();

 if(isset($_POST['add_device']))
{
	$devicetype=$_POST['devicetype'];
	$serial_no=$_POST['sr_no'];
	
	$label_array=$_POST['label_array'];
	
	//print_r($label_array);
	//echo "<br/>";
	$new_serial_no="";
$new_model_no="";
	$model_no=$_POST['m_no'];
	$brand=$_POST['brand'];
	$date=date("20y-m-d");
$count=count($serial_no);
for($i=0;$i<$count;$i++)
{
	$coldata=array("model_no"=>$model_no[$i],"serial_no"=>$serial_no[$i],"brand"=>$brand[$i],"date"=>$date);	
	$status=$obj->db_insert("device_detail",$coldata);
$new_serial_no .=$_POST['label_array'][$i]."-".$serial_no[$i];
$new_model_no .=$_POST['label_array'][$i]."-".$model_no[$i];
if($i<$count-1){$new_serial_no .="/";$new_model_no .="/";}
}



//echo "new_serial_no=$new_serial_no<br/>";
//echo "new_model_no=$new_model_no";
//exit;
$data="spic \n devicetype=$devicetype\n serial no=$new_serial_no\n
model no=$new_model_no\n Date:$date";
$path=qr_code($data);

$status=1;
$coldata=array("modelno"=>$new_model_no,"serialno"=>$new_serial_no,"devicetype"=>$devicetype,"status"=>$status,"date"=>$date,"qr_path"=>$path);	

$status=$obj->db_insert("device",$coldata);
if($status)
	header("Location:add.php?c=1");



}
else if(isset($_POST['issue']))
{
	echo"issue department<br/>";
	$device_type=$_POST['device_type'];
	$department=$_POST['department'];
	$temp=explode("|",$department);
	$department=$temp[1];
	$department_id=$temp[0];
	$remark=$_POST['remark'];
	
	$id_list=$obj->get_chb_value();

	$date=date("20y-m-d");
//exit;
//$status=$obj->db_insert("issue",$coldata);
//{
	
	$id_data=explode("|",$id_list);
	$issue_date=$date;
	for($i=0;$i<count($id_data);$i++)
	{

	$coldata=array("device_type"=>$device_type,"department_id"=>$department_id,"department"=>$department,"device_id"=>$id_data[$i],"date"=>$date,"remark"=>$remark);	
	$status=$obj->db_insert("issue",$coldata);
	
	
	$coldata=array("issue_status"=>1,"issue_date"=>$issue_date);	
	$obj->db_update("device",$coldata,"id=".$id_data[$i]);
		
	}
	
if($status)
	header("Location:issue.php?c=1");
//}
}
else if(isset($_POST['add_department']))
{
	echo"add department";
	$dp_name=$_POST['dp_name'];
	$address=$_POST['address'];
	$c_no=$_POST['contact_no'];
	$c_name=$_POST['c_name'];
	
$coldata=array("department"=>$dp_name,"address"=>$address,"contact_no"=>$c_no,"contact_name"=>$c_name);	

$status=$obj->db_insert("department",$coldata);
if($status)
	header("Location:department.php?c=1");

}


else if(isset($_POST['add_device']))
{
	echo"add device Qr_code";
	$model=$_POST['modelno'];
	$serial=$_POST['serialno'];
	$device_type=$_POST['devicetype'];
	$status=$_POST['status'];
	$date=date("20y-m-d");	
	require_once("mylinkfile.php");
require_once("connection.php");
//require_once("lib.php");
		
$coldata=array("modelno"=>$model,"serialno"=>$serial,"devicetype"=>$device_type,"status"=>$status,"date"=>$date,"qr_path"=>$path);	

$status=$obj->db_insert("device",$coldata);
if($status)
	header("Location:add.php?c=1");

}



function qr_code($qr_code_data)
{
$_REQUEST['data']=1;
	  $PNG_TEMP_DIR = dirname(__FILE__).DIRECTORY_SEPARATOR.'QR_CODE'.DIRECTORY_SEPARATOR;

    
    //html PNG location prefix
    $PNG_WEB_DIR = 'QR_CODE/';

    include "qrlib.php";    
    
    //ofcourse we need rights to create temp dir
    if (!file_exists($PNG_TEMP_DIR))
        mkdir($PNG_TEMP_DIR);
    
    
    $filename = $PNG_TEMP_DIR.'test123.png';
    
    //processing form input
    //remember to sanitize user input in real-life solution !!!
    $errorCorrectionLevel = 'L';
    if (isset($_REQUEST['level']) && in_array($_REQUEST['level'], array('L','M','Q','H')))
        $errorCorrectionLevel = $_REQUEST['level'];    

    $matrixPointSize = 4;
    if (isset($_REQUEST['size']))
        $matrixPointSize = min(max((int)$_REQUEST['size'], 1), 10);


    if (isset($_REQUEST['data'])) { 
    
	ECHO "DATA";
        //it's very important!
        if (trim($_REQUEST['data']) == '')
            die('data cannot be empty! <a href="?">back</a>');
            
        // user data
		//$model=$_POST['modelno'];
	//$serial=$_POST['serialno'];
	//$device_type=$_POST['devicetype'];
	//$status=$_POST['status'];
	$date=date("20y-m-d");	
	//$mydata="model:".$model."\n serial:".$serial."\n device_type:".$device_type."\n status:".$status."\n date:".$date;
        $mydata="$qr_code_data"; 
       
	$filename = $PNG_TEMP_DIR.'test'.md5($mydata.'|'.$errorCorrectionLevel.'|'.$matrixPointSize).'.png';
        QRcode::png($mydata, $filename, $errorCorrectionLevel, $matrixPointSize, 2);    
        
    } else {    
    
	ECHO "DATA NOT FOUND";
        //default data
        echo ': <a href="?data=like_that">.</a><hr/>';    
        QRcode::png('PHP QR Code :)', $filename, $errorCorrectionLevel, $matrixPointSize, 2);    
        
    }    
        
	$temp=explode('\\',$filename);
	print_r($temp);
	ECHO "<HR/>";
	//echo "filename:$filename";
	$filename="".$temp[count($temp)-1];
	//echo "new filename:$filename";
	
	$fname=explode("/",$filename);
	
	$fname=$fname[count($fname)-1];
	
	echo "<br/>fname=$fname<br/>";
return $path="qr_code/".$fname;
	
}
?>