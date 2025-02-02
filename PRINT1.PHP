<?php
require_once("mysqli_connection.php");
 require_once("oops_lib.php");?>

<!DOCTYPE html>
<html>
<head>
    <script>
function remove_id(i) {
  var x = document.getElementById("print_id");
  x.remove(x.selectedIndex);

  var list_option_value= document.getElementById("print_id");
var len=list_option_value.length;
var l_id_value="";       
for(var i=0;i<len;i++)
        {

            l_id_value +=list_option_value[i].value;
             if(i<len-1)
            l_id_value +="/";
        }

        document.getElementById('l_id').value=l_id_value;




}


        function add_id(i)
        {
            var list_id="list_"+i;
         var list_value=document.getElementById(list_id).value;
  //          alert(list_id+"="+list_value);
           //alert(list_id);

           



        var list_option_value= document.getElementById("print_id");
var flag=false;
        var len=list_option_value.length;
        for(var i=0;i<len;i++)
        {

            var temp=list_option_value[i].value;
            if(temp==list_value)
            {
                flag=true;
                break;
            }
   //         alert(temp);
        }

//        alert(flag);
        if(flag==false)
        {
 //       alert(len);




          const node = document.createElement("option");
node.innerHTML=list_value;
node.value=list_value;
document.getElementById("print_id").appendChild(node);








var list_option_value= document.getElementById("print_id");
var len=list_option_value.length;
var l_id_value="";       
for(var i=0;i<len;i++)
        {

            l_id_value +=list_option_value[i].value;
             if(i<len-1)
            l_id_value +="/";
        }

        document.getElementById('l_id').value=l_id_value;

        }
    

}
        </script>
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
      QR CODE GENRATE
      </div>

      <div class='panel-body min_h'>
     <div class='row'>
     <div class='col-md-7'>
	 ";
	 
echo "<form action='rpt.php?s=1' method='post'>";
$obj=new mylib();
$ob1=new mylib();
$obj->db_find("device_type","device");
$num=$obj->get_num_rows();
for($i=0;$i<$num;$i++)
{$data=$obj->get_row($i);
    $temp=str_replace("_", " ",$data['device']);
    $temp=ucfirst($temp);
    echo "<div class='row'>";
echo "<label class='col-md-offset-1 col-md-2 '><b>$temp</b></label>";
echo "<div class='col-md-6'>";
$list_id="list_".$i;
echo "<select class='form-control' id='$list_id'>";
$temp1=$data['device'];
//echo "<option value='select'>select</option>";
$sql="select * from device where devicetype='$temp1'";
$query=mysqli_query($con,$sql);
$num1=mysqli_num_rows();
while($row=mysqli_fetch_array($query))
{
echo "<option value='$row[0]'>$row[0]";

echo "</option>";
}
//'desktop'

echo "</select>";

echo "</div>";

echo "<div class='col-md-1'><input type='button' name='add_btn' value='Add id' class='btn btn-info' onclick='add_id($i)'/></div>";

echo "</div>";

}


echo "</div>";

echo "<div class='col-md-5'>";
echo "my list box";

echo "<select name='print_id'  id='print_id' class='form-control' size=10>";


echo "</select>";
echo "<div class='col-md-4'><input type='button' name='remove_btn' value='remove' class='btn btn-info' onclick='remove_id($i)'/></div>";

echo "</div>";
echo "</div>";

/*
echo "<div class='row'>
<label class='col-md-offset-1 col-md-3'><h3>Select Device</h3></label>
<div class='col-md-5'>";
echo "<select name='devicetype' class='form-control'>";
$obj=new mylib();
echo "<option value='all'>Select Device</option>"; 
//$data=$obj->get_row(0);
for($i=0;$i<$num;$i++)
{	$data=$obj->get_row($i);
$temp=str_replace("_", " ",$data['device']);
$temp=ucfirst($temp);
echo "<option value='$data[device]'>$temp</option>";
}
echo "</select>";
echo "</div>";
echo "</div>";
echo "<br/>";

*/

echo "<br/>";

echo "<div class='row'>
<div class='col-md-offset-1 col-md-5'>

<input type='hidden' name='l_id' id='l_id'/>
";
echo "<input type='submit' name='find' value='Print QR CODE' class='btn btn-info'>";
//echo "<input type='submit' name='remove' value='remove' class='btn btn-info ' onclick='remove_id($i)'>";

echo "</div>";
echo "</div>";
echo "<br/>";

echo "</form>";
/*

echo "
<div class='row'>
<label class='col-md-offset-1 col-md-2'>Select Device</label>
<div class='col-md-4'>";
echo "<select name='devicetype' class='form-control'>";
$obj=new mylib();
$obj->db_find("department","id,department");
$num=$obj->get_num_rows();
//$data=$obj->get_row(0);
for($i=0;$i<$num;$i++)
{	$data=$obj->get_row($i);
$temp=str_replace("_", " ",$data['department']);
$temp=ucfirst($temp);
echo "<option value='$data[department]'>$temp</option>";
}
echo "</select>";

echo "</div>";
/*
echo"<div class='row'>
	<div class='col-md-3'>
</br>
</br>
</br>
<input type='checkbox' name='working' value='working' checked/> working 
</br>
<input type='checkbox' name='non_working' value='non_working'/> non working 
</div>
</div>
"
;
*/



echo "</div>";








//include("footer.php");


?>
</div>

</body>

</html>