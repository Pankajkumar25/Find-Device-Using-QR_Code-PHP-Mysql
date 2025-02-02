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
      viewall";
	  
	  
$table_name="issue";
//if(isset($_REQUEST['a']))
	//$table_name="issue";
echo "  $table_name";

      echo"</div>

      <div class='panel-body min_h'>
    ";

	$obj= new mylib();
	if(isset($_REQUEST['r']))
	{
		echo "return case";
		$id_list=$obj->get_chb_value();
		
		
		$device_id=str_replace("|",",",$id_list);
		//echo "id_list=$id_list";
		$sys_date=date("20y-m-d");
		$col_list=array("issue_status"=>0);
		//$status=$obj->db_find("issue","device_id",$where_con);
		//$data=$obj->get_row(0);
		//$device_id=$data['id'];
		$issue_id=$_POST['issue_id'];
		$where_con="id in($device_id)";
	$status=$obj->db_update("device",$col_list,$where_con);
		$where_con="id in($issue_id)";
		$col_list=array("return_date"=>$sys_date);
	$status=$obj->db_update("issue",$col_list,$where_con);
		if($status==1)
			header("Location:issue_view.php?s=1");
	}
	else if(isset($_REQUEST['id']))
	{
		$id=$_REQUEST['id'];
	//	echo $id."<br/>";
		$where_con="id=$id";
		$col_list="device_id";
		$obj->db_find("issue",$col_list,$where_con);
		$data=$obj->get_row(0);
		$temp=$data['device_id'];
		$temp=str_replace("|",",",$temp);
		//echo $temp;
		$where_con="id in($temp)";
		
	$obj->view("device","*","$where_con",10,0,"id");
		echo "<form action='issue_view.php?r=1' method='post'>";
				echo "<input type='hidden' name='issue_id' value='$id' class='btn btn-info'/>";	
		echo "<input type='submit' value='Return' class='btn btn-info'/>";	
		echo "</form>";
	}
	else
	{
	echo "
	<div class='row'>
	<div class='col-md-offset-1 col-md-6'>
	<form action='issue_view.php' method='post'>";
	
	echo "<select name='department_id' class='form-control'>";

$obj->db_find("department","id,department");
$num=$obj->get_num_rows();
//$data=$obj->get_row(0);
echo "<option value='select'>Select Department</option>";
$status="";
if(isset($_POST['department_id']) &&$_POST['department_id']=="all" )
$status="selected";

echo "<option value='all' $status>All</option>";
for($i=0;$i<$num;$i++)
{
	$data=$obj->get_row($i);
	$id_value=$data['id'];
$status="";
if(isset($_POST['department_id']))
{	
$post_value=$_POST['department_id'];
	if($post_value==$id_value)
	$status="selected";
}
echo "<option value='$id_value' $status>$data[department] </option>";
}
echo "</select>
</div><div class='col-md-4'>
<input type='submit' value='Find' name='find' class='btn btn-info'/>
</div></div>
";
	
	echo "</form>";
	$where_con=" return_date=''";
	$col_list="id,device_type,device_id,date,remark";
	if(isset($_POST['find']))
	{	$department_id=$_POST['department_id'];
		if($department_id!="all")
		{$where_con="department_id='$department_id' and return_date=''";
		
		}
		else
		$col_list="id,department,device_type,device_id,date,remark";	
	}
	$obj->view($table_name,"$col_list","$where_con",10,0,"id","issue_view.php");
	
	
	
	}		
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