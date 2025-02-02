<script>

function chb_data(chb_name)
{
var chb_data=document.getElementsByName(chb_name);
var len=chb_data.length;
var chb_list="";
document.cookie="temp_value="+"";
for(var i=0;i<len;i++)
{
	
	if(chb_data[i].checked)
	{
		
		if(chb_list!="")
		chb_list +="|";

	chb_list +=chb_data[i].value;
	}
}
	document.cookie="temp_value="+chb_list;
document.getElementById('output').value=document.cookie;
	
//alert(chb_list);
}
</script>
<?php
include("config1.php");
 require("linkfile.php");
 
//include("mysqli_connection.php");
class mylib
{
//public const SERVER_value=SERVER; 

public $con;
public $file_path;
public $autoid;
public $row_data;
public $num_rows;
public $chb;
function  __construct()
{
	//a=1000;
	//echo SERVER_value;
	
	$this->con=mysqli_connect(SERVER,DB_USERID,DB_PASSWORD,DATABASE);
	
}

function __call($fname,$arglist)
{
	//echo "fname=$fname";
	$len=count($arglist);
	//echo "<br/>count=$len<hr/>";
	if($fname=="db_viewall")
	{
		switch($len)
		{
			case 2: $status=$this->my_find($arglist[0],$arglist[1],"");
				return $status;			
			break;
			case 3:// echo "case 3";
				 $status=$this->my_find($arglist[0],$arglist[1],$arglist[2]);
				 return $status;
			break;
			
		
		}
	}
	else if($fname=="view")
	{
		//echo "len=$len<hr/>";
		if(!isset($arglist[6]))
			$arglist[6]="";
		
	//	echo "arglist[6]=$arglist[6]";
		switch($len)
		{
			case 4: $status=$this->viewall($arglist[0],$arglist[1],$arglist[2],$arglist[3],0,"","");
				return $status;			
			break;
			
			case 5: $status=$this->viewall($arglist[0],$arglist[1],$arglist[2],$arglist[3],$arglist[4],"","");
				return $status;			
			break;
			case 6: 
			$status=$this->viewall($arglist[0],$arglist[1],$arglist[2],$arglist[3],0,$arglist[5],"");
				return $status;
			break;
			case 7: 
			
			$status=$this->viewall($arglist[0],$arglist[1],$arglist[2],$arglist[3],0,$arglist[5],$arglist[6]);
				return $status;
			break;
			
		
		}
	}	
	else if($fname=="db_find")
	{
		switch($len)
		{
			case 2: 		
			$status=$this->my_find($arglist[0],$arglist[1],"");
return $status;			
			break;
			case 3:// echo "case 3";
				 $status=$this->my_find($arglist[0],$arglist[1],$arglist[2]);
				 return $status;
			break;
		
		}
	}
	else if($fname=="db_insert")
	{
		
		switch($len)
		{
			case 2:
		//	echo "arg 0=".$arglist[0];
			//			echo "arg 1=".print_r($arglist[1]);

			//echo "<hr/>";
			//echo "case 2 with db_insert function"; 

			$status=$this->my_insert($arglist[0],$arglist[1]);
			return $status;
			
			
			break;
			case 3:
			$col_list=$arglist[1];
			$col_no=$arglist[2];
			$i=0;
			$where_con="";
			foreach($col_list as $key=> $val)
			{
				if($i==$col_no)
				{
					$where_con="where $key= '$val'";
					
				}//echo $key ."-".$val."<br/>";
			$i++;
			}
//			print_r($col_list);
//			echo "<hr/>$col_no";
	//echo $where_con;
//echo "<hr/>";	
			
			
			
			
		//	$sql="select * from ".$arglist[0]." ".$where_con;
		//	$query=mysqli_query($this->con,$sql);
		//	$num=mysqli_num_rows($query);
			
			$this->my_find($arglist[0],$arglist[1],$where_con);
			$num=$this->num_rows;
			
			
			
			
			
			if($num==0)
			{
			$status=$this->my_insert($arglist[0],$arglist[1]);
				
				return $status;
			}
			else
			{
				return false;
				
			}	
			

				break;
			case 5:
		echo "case 6 with db_insert function<br/>"; 
		$status=$this->my_insert($arglist[0],$arglist[1]);
			if($status)
			{
					$file_status=$this->upload($arglist[2],$arglist[3],$this->autoid);
					if($file_status)
					{
							
						$col_data=Array($arglist[4]=>$this->file_path);
						$where_con="id=".$this->autoid;
						//$where_con=$arglist[5]."=".$this->autoid;
						
						$update_status=$this->my_update($arglist[0],$col_data,$where_con);
						if($update_status)
						return true;
						else
							return false;
					}
					else
						return false;
			}
			else
				return false;
	
		
		/*for($i=0;$i<6;$i++)
			{
				echo "arglist[$i].=".$arglist[$i]."<br/>";
			}
			*/
			break;
		}
		
	}
	else if($fname=="db_delete")
	{
		switch($len)
		{
			case 2:
						echo "db_delete case2";
						echo $arglist[1];
						echo "$arglist[0]";
			$status=$this->my_delete($arglist[0],$arglist[1],"");
				return $status;
			break;
			case 3:
			$status=$this->my_delete($arglist[0],$arglist[1],$arglist[2]);
			return $status;
			break;
		}
		
	}
	else if($fname=="db_upload")
	{
		switch($len)
		{
			case 2:
						echo "db_upload case2";
						$file_name=rand(10000,99999);
						$file_name .="_".Date("d_m_20y");
						return $status=$this->upload($arglist[0],$arglist[1],$file_name);
			break;
			case 3:
						
						return $status=$this->upload($arglist[0],$arglist[1],$arglist[2]);
			break;
			case 4:
						echo "db_upload case2";
						$file_name=rand(10000,99999);
						$file_name .="_".Date("d_m_20y");
						$status=$this->upload($arglist[0],$arglist[1],$file_name);
						if($status)
						{
								//echo "case =file_path=$this->file_path<br/>";
							//	exit;
							
							$data=Array($arglist[3]=>$this->file_path);
						return $status=$this->my_insert($arglist[2],$data);
							
							
						}
						else
						{return false;
						}
			break;
		//
			case 5:
						echo "db_upload case2";
						$status=$this->upload($arglist[0],$arglist[1],$arglist[2]);
						if($status)
						{
								//echo "case =file_path=$this->file_path<br/>";
							//	exit;
							
							$data=Array($arglist[4]=>$this->file_path);
						return $status=$this->my_insert($arglist[3],$data);
							
							
						}
						else
						{return false;
						}
			break;
		//	case 3:
		//	break;
		}
		
	}
	else if($fname=="db_update")
	{
		switch($len)
		{
		case 2: return $status=$this->my_update($arglist[0],$arglist[1],"");break;
		case 3: return $status=$this->my_update($arglist[0],$arglist[1],$arglist[2]);break;
		}
	}
	else if($fname=="db_update_upload")
	{
		switch($len)
		{
			case 5:
				echo "db_update_upload case5";
						$file_name=rand(10000,99999);
						$file_name .="_".Date("d_m_20y");
						
						$status=$this->upload($arglist[0],$arglist[1],$file_name);
						if($status)
						{
					
							$data=Array($arglist[3]=>$this->file_path);
					
						return $status=$this->my_update($arglist[2],$data,$arglist[4]);
					
						}
						else
							return false;
			break;
		}
		
	}
	
	
	
	
	
}
	
	function my_insert($tb_name,$col_data)
	{
	$col_list="";
	$col_values="";
	$count=count($col_data);
	//echo "count=$count<br/>";
	$c=1;
	foreach($col_data as $c_key=>$c_val)
	{
		//echo " $c c_key =$c_key";
		//echo "<br/>";
		//echo "c_val= $c_val";
		//echo "<hr/>";
		$col_list .=$c_key;
		$col_values .="'$c_val'";
		if($c<$count)
	
		{
		$col_list .=",";
		$col_values .=",";
		}
		$c++;
	}
//		echo "insert function<br/>tb_name=$tb_name";
$sql="insert into $tb_name($col_list) values($col_values)";
//echo $sql;
try
{
if(mysqli_query($this->con,$sql))
{
	
$this->autoid=mysqli_insert_id($this->con);
return true;	
}
else
{

return false;
}

}
catch(Exception $ex)
{
	echo "$sql";
	return false;
	
}
	}
	/*
Step1:If you want to update so call this function like
:$obj->my_update(empinfo,"empid","id");.
*$tb_name="Here you type table name";
*where_con="type like this in place of id=*id in your query";
*col_data="help to find in column's data";
 */	
	function my_update($tb_name,$col_data,$where_con)
	{
//echo "table_name=$tb_name";
//echo "<br/>";
//print_r($col_data);
//echo "<hr/>";

$col_list="";
$count=count($col_data);

//echo "count=$count";
$c=1;
	foreach($col_data as $c_key=>$c_val)
	{
		//echo " $c c_key =$c_key";
		//echo "<br/>";
		//echo "c_val= $c_val";
		//echo "<hr/>";
		$col_list .="$c_key='$c_val'";
	if($c<$count)
		$col_list .=",";
	$c++;
	}
	

if($where_con!="")
	$where_con ="where ".$where_con;
$sql="update $tb_name set $col_list $where_con";
//echo "$sql";

if(mysqli_query($this->con,$sql))
{
return true;	
}
else
{
return false;
}
	}
/*
Step1:If you want to delete so call this function like
:$obj->my_delete(empinfo,"empid","id");.
*$table_name="Here you type table name";
*where_con="type like this in place of id=*id in your query";
*col_name="help to find in column's name";

 */	

function my_delete($table_name,$where_con,$col_name)
{
if($where_con!="")
	$where_con ="where ".$where_con;

if($col_name!="")
{
	$sql="SELECT $col_name FROM $table_name $where_con";
	$query=mysqli_query($this->con,$sql);
	$row_data=mysqli_fetch_row($query);
	$image_url=$row_data[0];
	echo "<br/>$image_url";
}	
	$sql="delete from $table_name $where_con";
echo "<br/>$sql";
if(mysqli_query($this->con,$sql))
{
	
if($col_name!="")
{	
unlink($image_url);
}

	
	header("location:test.php?empid=$empid&case=del");
}
else
echo "error";

	
}
/*
Step1:If you want to upload image so call this function like
:$obj->upload($image,"Image","");.
*$image=basically this variable contain value of image.
*$dir_name= name of the folder in  which images are saved like (image).
*file_id= 
 */
function upload($image,$dir_name,$file_id)
{
	echo "upload function in oops lib<br/>";
	//print_r($image);
	//$count=1;
	
	//if($image['name']!='')
	

	if(is_array($image['name']))
	{
		$count=count($image['name']);
	}
	else
		$count=1;

	
	if($count==1)
	{
	echo "case 1";	
	$file_path=$image['tmp_name'];
	$file_name=$image['name'];
	if($file_id!="")
	{
	$temp=explode(".",$file_name);
	$len=count($temp);
	
	$this->file_path=$dir_name."/".$file_id.".".$temp[$len-1];
	}
	else
	$this->file_path=$dir_name."/".$file_name;
		
	//echo "upload =file_path=$this->file_path<br/>";
//	echo "new path=$new_path<br/>";
//	exit;
	if(move_uploaded_file($file_path,$this->file_path))
	

return true;
	else
return false;
	}
	else if($count>1)
	{
	//	echo "case 2<br/>";
	$count=count($image['name']);
	//echo "<hr/>count=$count<br/>";
				$rand=rand(10000,99999);
$date=date("d_m_20y");
$rand .="_".$date;
$file_count=0;
			for($i=0,$j=1;$i<count($image['name']);$i++,$j++)
			{
				
				
				$path=$image['tmp_name'][$i];
				$name=$image['name'][$i];
				$temp=explode(".",$name);
				$len=count($temp);

				$file_name=$rand;
				if($file_id!="")
				$file_name=$file_id;
			
				$file_name .="_".$j.".".$temp[$len-1];
				$new_path="$dir_name"."/".$file_name;
			//echo "image no=$i path=$path new path=$new_path<br/>";
			
			if(move_uploaded_file($path,$new_path))
			{$file_count++;}else{return false;}
	
			}

		//echo "$file_count file uploaded";
		return true;

	}
	
	
	
}

/*
Step1:If you want find id so call this function like
:$obj->my_find("empinfo2","*","id=$id");
*$table_name="Here you type table name";
*$col_list="Type col_name or *"; 
*where_con="type like this in place of id=*id in your query";
 */
function my_find($table_name,$col_list,$where_con)
{
	$where_str="";
	if($where_con!="")
		$where_str=" where $where_con";
	$sql="select $col_list from $table_name $where_str";
	//echo $sql;
	//exit;
	$query=mysqli_query($this->con,$sql);
	$this->num_rows=mysqli_num_rows($query);
	if($this->num_rows>0)
	{
//	echo "num of rows=".$this->num_rows;
		
		if($this->num_rows==1)
		$this->row_data[0]=mysqli_fetch_assoc($query);
		else 
		{
			$i=0;
			while($temp=mysqli_fetch_assoc($query))
			{
				$this->row_data[$i]=$temp;
				$i++;
				
			}
		}
		
		
		//echo "found";
		//$row_data=mysqli_fetch_row($query);
		//print_r($row_data);
	return true;
	}
	else
	{
return false;
	}
	
}
/*
Step1:If you want viewall with paging so call this function like
:$obj->viewall("empinfo2","*","",$pagesize);.
 
Step2:In this function you must pass 5 arrguments.
*$table_name="Here you type table name";
*$col_list="Type col_name or *"; 
*where_con=" type like this in place of id=*id in your query";
*page_size="if want to decide the length of your list Just enter your prefered pagesize like this $pagesize=1;"; 
*caseno="empty like (,"") at the end of all arrguments";

*/
function viewall($table_name,$col_list,$where_con,$page_size,$caseno,$output_col_name,$url)
{
	
	//echo "url=$url<br/>output_col_name=$output_col_name";
	$where_str="";
	if($where_con!="")
		$where_str="where $where_con";
	$sql="select $col_list from $table_name $where_str";
	//echo $sql."<br/>";
	$query_result=mysqli_query($this->con,$sql);
	$total_rows=mysqli_num_rows($query_result);
	//echo "total_rows=".$total_rows;	
	
	$total_pages=$total_rows/$page_size;
	$temp=explode(".",$total_pages);
	if(count($temp)>1)
		$total_pages=$temp[0]+1;

	$pageno=0;
	if(isset($_REQUEST['pageno']))
	$pageno=$_REQUEST['pageno'];
	
		$offset=$pageno*$page_size;
$temp_page_no=$pageno+1;
	//echo "offset=$offset page no=$pageno page size=$page_size total_pages=$total_pages ";
	//echo "<h2>$temp_page_no / $total_pages</h2>";
	
	$sql .=" limit $offset,$page_size";
	$query_result=mysqli_query($this->con,$sql);
	$num_rows=mysqli_num_rows($query_result);
	$num_cols=mysqli_num_fields($query_result);
	//echo "<br/>$sql";
	//echo "<br/>num rows=$num_rows";

	
	
	
	//echo "caseno =$caseno";
	if($caseno==0)
	{
		//echo"<center><h2>VIEW ALL DATA</h2></center>";
		echo "<div class='col-md-12'>";
		echo "<div class='panel panel-primary'>";

		echo "<input type='hidden' id='output' name='output'/>";
		if(isset($_COOKIE['temp_value']))
		$this->chb=$_COOKIE['temp_value'];
		
//		echo "output value=".$this->chb;
	echo "<table class='table table-bordered' bg-primary >";
		echo "<tr class='bg-primary'>";
		$col_list=array();
		for($i=0;$i<$num_cols;$i++)
		{
			$col_temp=mysqli_fetch_field($query_result);
			
			
			$col_list[$i]=$col_temp->name;
			$col_name=ucfirst($col_temp->name);

			$col_name=str_replace("_"," ",$col_name);
			if($col_list[$i]==$output_col_name  && $url!="")
			echo"<th>View</th>	<th>$col_name</th> "; 
		else
				echo"<th>$col_name</th>"; 
		}
		echo "</tr>";
	
	while($row_data=mysqli_fetch_array($query_result))
	{
		echo "<tr>";
		for($i=0;$i<$num_cols;$i++)
		{

			if(ucfirst($col_list[$i])==ucfirst($output_col_name))
			{

				if($url!="")
				{
					 $temp=explode(".",$url);
					 $len=count($temp);
					 if($len==2)
					echo"<td><a href='$url?$output_col_name=$row_data[$i]' class='btn btn-info'>View </a></td><td>$row_data[$i]</td>";
					else
					{
						echo "<td>";
						if($row_data[$i]!="")
						echo"<img src='$row_data[$i]' width=100/>";
						else
						echo "not found";	
					echo "</td>";
					}	
				
				}else
				echo"<td><input type='checkbox' name='$output_col_name' value='$row_data[$i]' onchange=\"chb_data('$output_col_name')\"/> $row_data[$i]</td>";
				
				
			}
			else
			echo"<td> $row_data[$i]</td>"; 
		}
		echo "</tr>";
	}
	
	echo "</table>";
	
	echo"</div>";
	//echo"<center><h2 class='bg-info'>Total NO:$num_rows<h2></center><br/>";
	echo"</div>";
	}else
	{
		
				$col_size=0;
		switch($caseno)
		{
			case 1:$col_size="col-md-12";break;
			case 2:$col_size="col-md-6";break;
			case 3:$col_size="col-md-4";break;
			case 4:$col_size="col-md-3";break;
			case 5:
			case 6:$col_size="col-md-2";break;
	


	}
		//echo "case no=$caseno col_size:$col_size";



		
		
		$collist=array();

for($i=0;$i<$num_cols;$i++)
		{
			$col_temp=mysqli_fetch_field($query_result);
			
			$col_name=ucfirst($col_temp->name);
			$col_name=str_replace("_"," ",$col_name);
		$collist[$i]=$col_name; 
		}
	
		echo"<center><h2>This is Grid Form</h2></center>";
	while($row_data=mysqli_fetch_array($query_result))
	{
		echo "<div class='$col_size'>";
		echo "<div class='panel panel-primary'>";
		
		//echo "<div class='panel-heading '>";
	
		echo "<table class='table table-bordered' bg-primary>";
		for($i=0;$i<$num_cols;$i++)
		{
			if($i)
		   echo "<tr class='info'><th>$collist[$i]</th><td>$row_data[$i]</td></tr>";	
		   else
	       echo "<tr class='bg-primary'><th>$collist[$i]</th><td>$row_data[$i]</td></tr>";
		}
		echo "</table>";
		echo "</div>";
		echo "</div>";
		//echo "</div>";
		
	}
	}
	
	
	
	echo "<center>";
	
	$url=$_SERVER['PHP_SELF'];
	$temp_url=explode("/",$url);
	//print_r($temp_url);
	$len=count($temp_url);
	//echo "len=$len";
	$url=$temp_url[$len-1];
	//echo "url=$url";
	if($pageno>0)
	{
	$lasetpageno=$pageno-1;
	echo "<a href='$url?pageno=$lasetpageno'><spam class='btn btn-info'>Previous</spam></a>";
	
	}
	
	
//	echo "pageno=$pageno  total_pages=$total_pages<hr/>";
	$temp=0;
	$i_value=0;
	$max_pageno=10;
	$i_end_value=10;
	$c=0;
	if($total_pages<10)
	$i_end_value=$total_pages;


	if($pageno>5 && $total_pages>10)
	{
//	$c=round($total_pages/$pageno);
	
	
			$i_value=$pageno-5;
	
		if($total_pages-5>$pageno)
		{
		$i_end_value=$pageno+5;
		}
		else
		{
		
		
			
			
		$i_end_value=$total_pages;
			$i_value=$pageno-5;
	$temp=$i_end_value-$i_value;
	switch($temp)
	{
		case 6:$i_value=$i_value-4;break;
		case 7:$i_value=$i_value-3;break;
		case 8:$i_value=$i_value-2;break;
		case 9:$i_value=$i_value-1;break;
		
	}
		}
		
	}
	
	//echo "c=$c i=$i_value i_end_value=$i_end_value  temp=$temp<br/>" ;
	for($i=$i_value,$j=$i+1;$i<$i_end_value;$i++,$j++)
	{

		if($i==$pageno)	
		{	echo "<b><font size=10px>$j </font></b> &nbsp;&nbsp;&nbsp;";
		}else			
		echo "<a href='$url?pageno=$i'>$j</a> &nbsp;&nbsp;&nbsp;";
		
	}
	
	
	if($pageno<$total_pages-1)
	{
	$pageno++;
	echo "<a href='$url?pageno=$pageno'><spam class='btn btn-info'>Next</spam></a>";
	}
	echo "</center>";
	
}

/*
Step1:If you want fetch row || rows so type$this->get_row. 
Step2: Programer must pass (arrgument=$indexno) in this function.  
*/

function get_row($indexno)
{
	return $this->row_data[$indexno];
}
/*
Step1:If you want fetch numbers of rows so type$this->get_num_rows. 
*/
function get_num_rows()
{
	return $this->num_rows;
}	
function get_chb_value()
{
	$this->chb=$_COOKIE['temp_value'];
		
	return $this->chb;
}

function cnt($table_name,$col_name)
{
	
	//$where_str="";
	//if($where_con!="")
		//$where_str="where $where_con";
	$sql="select $col_name from $table_name";
	//echo $sql."<br/>";
	$query_result=mysqli_query($this->con,$sql);
	$total_cols=mysqli_num_rows($query_result);
	echo "total=".$total_cols;	
	
	
}





	
}
?>