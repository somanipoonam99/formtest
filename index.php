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
    </style>
   </head>
<body>

<!-- Staring of  Php script for validation -->

     <?php
     // define variables to empty values  for Error Message in Validation
     $fnameErr = $lnameErr=$numberErr=$emailErr=$talkErr=$imageErr="";
 
     if ($_SERVER["REQUEST_METHOD"] == "POST") {  
    
       //Getting all input Fields values

        $firstName = $_POST['firstName'];
	$lastName = $_POST['lastName'];
	$email = $_POST['email'];
	$number = $_POST['number'];
        $talktitle = $_POST['talktitle'];
        $image = $_FILES['image']['name'];
        $image_tmp = $_FILES['image']['tmp_name'];
        //Store image temp name in images folder
        move_uploaded_file($image_tmp,"images/$image");

       
             $extension = substr($image,strlen($image)-4,strlen($image));
             // allowed extensions
             $allowed_extensions = array(".jpg","jpeg",".png",".gif");

             // Validation for allowed extensions 
             if(!in_array($extension,$allowed_extensions))
               {
                $imageErr="Invalid format. Only jpg / jpeg/ png /gif format allowed";
              $Err[]='1';
                }

             
             //  First Name Validtion  
            if (!preg_match ("/^[a-zA-z]*$/", $firstName) ) {  
            $fnameErr = "Only alphabets are allowed."; 
             $Err[]='1';
             
              }  
          

            // Last Name Validtion  
           if (!preg_match ("/^[a-zA-z]*$/", $lastName) ) {  
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
?>
<!-- Ending of  Php script for validation -->
<!--  starting Form Fields -->

    <div>
      <h1>Registration Form</h1>
        
            <form  action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
                 
                <div class="box">
                <label class="required" for="firstName">First Name</label><br>
                <input  type="text" id="firstName" name="firstName"  placeholder="your answer" required/>
                <span class="error"> <?php echo $fnameErr; ?> </span>  
               </div>
               <div class="box">
                <label   class="required" for="lastName">Last Name</label><br>
                <input type="text" id="lastName" name="lastName" placeholder="your answer" required/>
                <span class="error"> <?php echo $lnameErr; ?> </span>
              </div>
             
              <div class="box">
                <label   class="required" for="email">Email</label><br>
                <input type="text" id="email" name="email" placeholder="your answer" required/>
                <span class="error"> <?php echo $emailErr; ?> </span>
              </div>
              
              <div class="box">
                <label class="required" for="number">Mobile Number</label><br>
                <input type="number" id="number" name="number" placeholder="your answer" required/>
              <span class="error"> <?php echo $numberErr; ?> </span>
              </div>
                <div class="box">
                <label   class="required" for="text">Talk Title</label><br>
                <input type="text" id="talktitle" name="talktitle" placeholder="your answer" required/>
                 <span class="error"> <?php echo $talkErr; ?> </span>
              </div>

               <div class="box">
               <label class="required" for="image">Profile Photo </label><br>
               <input type="file" name="image" id="image" required/><br>
               <span class="error"> <?php echo $imageErr; ?> </span>
                                    
               </div>

               <input type="submit"  class="button" name="submit" value="submit" /> 

             <!-- To view All Submitted Records -->
               <h5><a href="display.php">  View All Records </a> </h5>

             

            </form>

          <p> Created by<b> Poonam Somani </b></p>
          </div>
          
        </div>
      
   
<!-- Ending form Fields-->


<!-- Statring Php script for insertion -->

<?php  

//To check there is no error    
if(!isset($Err))
{
 if(isset($_POST['submit'])) {  
        
        // Connect to database


        $con = mysqli_connect("localhost","root","","formtest");


        //Insertion Query
        $query = "insert into form (firstname,lastname,email,number,talktitle,profileimage) values ('$firstName','$lastName','$email','$number','$talktitle','$image')";

        $result = mysqli_query($con, $query);

        if($result==1)
        {       

        echo "<Script> alert('Response Added Successfully !');</script>";
        echo"<script> window.location='display.php' </script>";


        }
        else {       

        echo "<Script> alert('Insertion Failed !Try Again');</script>";

             }
}

}

else
{
echo "<script> alert('something went wrong') </script>";
}

?>

  </body>
<!-- Ending Php script for insertion -->

</html>