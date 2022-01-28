<?php

$con = mysqli_connect("localhost","root","","formtest");
if($_GET['action']='del')
{
$id=intval($_GET['nid']);

$query=mysqli_query($con,"DELETE FROM `form` WHERE id='$id'");
if($query)
{
echo " <script> alert('Record Deleted'); </script>";
include('display.php');
}
else{
echo "Something went wrong . Please try again.";    
} 
}

?>