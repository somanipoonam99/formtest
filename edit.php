<!DOCTYPE>
<html>
  <head>
    <title>Registration Test Page Assignment</title>
    <style>
 
        /* Styling the Body element i.e. Color,
        Font, Alignment */
        body {
            background-color: #05c46b;
            font-family: Verdana;
            text-align: center;
        }
 
        /* Styling the Form (Color, Padding, Shadow) */
        form {
            background-color: #fff;
            max-width: 400px;
            margin: 50px auto;
            padding: 30px 20px;
            box-shadow: 2px 5px 10px rgba(0, 0, 0, 0.5);
         text-align: left;
        }

         /* Styling for box element (Input Fields)*/ 
        .box
          {
              
            border:1px solid grey;
            border-radius:3px;
            padding:15px;
            margin:30px;
          }
         .box input
          {
            margin-top:10px;
              border-top-style: hidden;
              border-right-style: hidden;
              border-left-style: hidden;
              outline: none;

            
           }

         /* Style for Astrik symbol aftet content */
           .required:after {
            content:" *";
            color: red;
            }

         /* Style for Error Msg */
         .error {color: #FF0001;}

         /* style for view record link */
         h5{
         text-align:right;

          }
         /* Styling Button */
        .button {
            background-color: #05c46b;
            border: 1px solid #777;
            border-radius: 2px;
            font-family: inherit;
            font-size: 21px;
            display: block;
            width: 30%;
            margin-top: 50px;
            margin-bottom: 20px;
            margin-left: 30px;
        }
/* Upload button Styling */
   .upload {
      background-color: #05c46b;
            border: 1px solid #777;
            border-radius: 2px;
            font-family: inherit;
            font-size: 18px;
            display: block;
            width: 30%;
            margin-top: 10px;
            margin-bottom: 10px;
            margin-left: 30px;

}
    </style>
   </head>
<body>







<?php
//Connect to database
$con = mysqli_connect("localhost","root","","formtest");
//Get Record id
$id=$_REQUEST['nid'];
?>
<!--  starting Update form-->
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Update Record</title>
<link rel="stylesheet" href="css/style.css" />
</head>
<body>
<div class="form">
<h1>Update Record</h1>

<!-- Check validation-->
<?php

  // define variables to empty values  for Error Message in Validation
     $fnameErr = $lnameErr=$numberErr=$emailErr=$talkErr=$imageErr="";
   if ($_SERVER["REQUEST_METHOD"] == "POST") {  
   
if(isset($_POST['new']) && $_POST['new']==1)
{
$id=$_REQUEST['id'];
$firstname =$_POST['firstName'];
$lastname =$_POST['lastName'];
$email =$_POST['email'];
$number =$_POST['number'];
$talktitle =$_POST['talktitle'];
$image = $_FILES['image']['name'];
$image_tmp = $_FILES['image']['tmp_name'];
        //Store image temp name in images folder
        move_uploaded_file($image_tmp,"images/$image");


  $extension = substr($image,strlen($image)-4,strlen($image));
             // allowed extensions
             $allowed_extensions = array(".jpg","jpeg",".png",".gif");

             // Validation for allowed extensions .in_array() function searches an array for a specific value.
             if(!in_array($extension,$allowed_extensions))
               {
                $imageErr="Invalid format Only jpg / jpeg/ png /gif format allowed";
              
                }

             //  First Name Validtion  
            if (!preg_match ("/^[a-zA-z]*$/", $firstname) ) {  
            $fnameErr = "Only alphabets are allowed."; 
             $Err[]='1';
             
              }  
          

            // Last Name Validtion  
           if (!preg_match ("/^[a-zA-z]*$/", $lastname) ) {  
            $lnameErr = "Only alphabets are allowed."; 
             $Err[]='1';
             
            } 
             
              // Mobile Number Validation
             if (!preg_match ("/^[0-9]*$/", $number) ){  
             $numberErr = "Only numeric value is allowed.";  
            $Err[]='1';
              } 
             
         //check mobile no length should not be less and greator than 10  
          if (strlen ($number) != 10) {  
            $numberErr = "Mobile no must contain 10 digits.";  
           $Err[]='1';
            }  
            

             //  Email Validtion 
              $pattern = "^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^";  
               if (!preg_match ($pattern, $email) ){  
                $emailErr = "Email is not valid.";  
                $Err[]='1';
               } 
            
            //  Talk Title Validtion  
             if (!preg_match('/^[\p{L} ]+$/u', $talktitle)){
            $talkErr = "Only letter and space are allowed.";  
             $Err[]='1';
              }   
        }  
}   

// to fetch record details 
$query = "SELECT * from form where id='".$id."'"; 
$result = mysqli_query($con, $query) or die ( mysqli_error());
$row = mysqli_fetch_assoc($result);
?>

<div>

<form name="form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data"   > 
<input type="hidden" name="new" value="1" />
<input name="id" type="hidden" value="<?php echo $row['id'];?>" />

 <div class="box">
                <label class="required" for="firstName">First Name</label><br>
                <input type="text" name="firstName" required value="<?php echo $row['firstname'];?>" />
               <span class="error"> <?php echo $fnameErr; ?> </span>
</div>

<div class="box">
                <label class="required" for="lastName">Last Name</label><br>
<input type="text" name="lastName" required value="<?php echo $row['lastname'];?>" />
 <span class="error"> <?php echo $lnameErr; ?> </span>
  
</div>
               <div class="box">
                <label   class="required" for="email">Email</label><br>
<input type="email" name="email"  required value="<?php echo $row['email'];?>" />
 <span class="error"> <?php echo $emailErr; ?> </span>

</div>
<div class="box">
                <label class="required" for="number">Mobile Number</label><br>
<input type="number" name="number"  required value="<?php echo $row['number'];?>" />
 <span class="error"> <?php echo $numberErr; ?> </span>
</div>
<div class="box">
                <label   class="required" for="text">Talk Title</label><br>
<p><input type="text" name="talktitle" required value="<?php echo $row['talktitle'];?>" />
 <span class="error"> <?php echo $talkErr; ?> </span>
</div>


               <div class="box">
               <label class="required" for="image">Profile Photo </label><br>
               <img src="images/<?php echo htmlentities($row['profileimage']);?>" width="100"/>
                <br>
               <input type="file" name="image" id="image"/><br>
<span class="error"> To update image click upload button </span> 
 <input name="upload"  class="upload" type="submit" value="Upload" />
                 </div>

 <p><input name="submit" class="button" type="submit" value="Update" /></p>
 <h5><a href='display.php'> View Updated Record </a></h5>
</form>

          
 <!-- Ending of update form-->      
<?php 

// to check validation error
if(!isset($Err))
{
 if(isset($_POST['submit'])) {  

// update record 

$update="update form set 
firstname='".$firstname."', 
lastname='".$lastname."', 
email='".$email."',
number='".$number."',
talktitle='".$talktitle."'
where id='".$id."'";
mysqli_query($con, $update) or die(mysqli_error());

echo "<script> alert('Record updated Successfully')  </script>";
echo"<script> window.location='display.php' </script>";

}
}
else
{
echo "<script> alert('something went wrong') </script>";
}

// To update images if uploaded 

if(isset($_POST['upload'])) {


// check image empty validation
  if (empty($_POST["image"])) {
    echo" <script> alert('Image is required')";
  }

// update image 

$update="update form set
 profileimage='".$image."' 
where id= '".$id."'";
mysqli_query($con, $update) or die(mysqli_error());

echo "<script> alert('Image updated Successfully')  </script>";
}

?>
</div>
</div>
<p> Created by<b> Poonam Somani </b></p>
</body>
</html>