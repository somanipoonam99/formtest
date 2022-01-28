<html>
<head>
<style>
#student {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 80%;
}

#student td, #customers th {
  border: 1px solid #ddd;
  padding: 8px;
}

#student tr:nth-child(even){background-color: #f2f2f2;}

#student tr:hover {background-color: #ddd;}

#student th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #04AA6D;
  color: white;
}

#edit
{
color:#04AA6D;
text-decoration:none;
font-weight:bold;
}
#delete
{
color:#ff0000;
text-decoration:none;
font-weight:bold;
}

h4{
text-align:center;
}



</style>

</head>
<body>

<h1> All Details </h1>
<h4> <a href="index.php">  ADD NEW RECORD </a></h4>

<table id="student">
<tr>
<th>  SrNo </th>
<th>  First Name </th>
<th>  Last Name </th>
<th>  Email </th>
<th>  Mobile No</th>
<th>  Talk Title</th>
<th>  Profile </th>
<th>  Edit </th>
<th>  Delete</th>
</tr>



<?php
//connect database

  $con = mysqli_connect("localhost","root","","formtest");

$query=mysqli_query($con,"select * from form;");
$rowcount=mysqli_num_rows($query);
if($rowcount==0)
{
?>




<tr>

<td colspan="4" align="center"><h3 style="color:red">No record found</h3></td>
</tr>
<?php 
} else {
while($row=mysqli_fetch_array($query))
{
?>

 <tr>
<td><b><?php echo htmlentities($row['id']);?></b></td>
<td><b><?php echo htmlentities($row['firstname']);?></b></td>
<td><b><?php echo htmlentities($row['lastname']);?></b></td>
<td><?php echo htmlentities($row['email'])?></td>
<td><b><?php echo htmlentities($row['number']);?></b></td>
<td><b><?php echo htmlentities($row['talktitle']);?></b></td>
<td><img src="images/<?php echo htmlentities($row['profileimage']);?>" width="50" height="50"/></td>



<td ><a  id="edit"href="edit.php?nid=<?php echo htmlentities($row['id']);?>"> EDIT </a></td>
    <td ><a id="delete" href="delete.php?nid=<?php echo htmlentities($row['id']);?>&&action=del" onclick="return confirm('Do you reaaly want to delete ?')"> DELETE</a> </td>
       
</tr>

<?php } } ?>
                                               
                                           
</table>
</body>
</html>              








