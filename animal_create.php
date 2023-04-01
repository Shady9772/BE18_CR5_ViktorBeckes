<?php
require_once "components/database.php";
require_once "components/pictures.php";

session_start();
     //imports my connect to database file

    if(!isset($_SESSION["user"]) && !isset($_SESSION["adm"])){
        header("Location: ../../index.php");
    }
    if(isset($_SESSION["user"])){
        header("Location: ../../home.php");
    }



if ($_POST) {  
   $name = $_POST["name"];
   $age = $_POST["age"];
   $picture = $_POST["picture"];
   $size = $_POST["size"];
   $vaccinated = $_POST["vaccinated"];
   $location = $_POST["location"];
   $description = $_POST["description"];
   
   $uploadError = '';
   //this function exists in the service file upload.
   $picture = file_upload($_FILES['picture']); 
   
   $sql = "INSERT INTO `animals`(`name`, `description`, `age`, `size`, `picture`, `vaccinated`, `location`, `status`) VALUES ('$name','$description','$age','$size','$picture->fileName','$vaccinated','$location','user')";

   if (mysqli_query($connect, $sql) === true) {
       $class = "success";
       $message = "The entry below was successfully created <br>
            <table class='table w-50'><tr>
            <td><span>Name:</span> $name </td>
            </tr></table><hr>";
       $uploadError = ($picture->error !=0)? $picture->ErrorMessage :'';
   } else {
       $class = "danger";
       $message = "Error while creating record. Try again: <br>" . $connect->error;
       $uploadError = ($picture->error !=0)? $picture->ErrorMessage :'';
   }
   mysqli_close($connect);
} else {
   header("location: index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
   <head>
       <meta charset="UTF-8">
       <title>Added Animal</title>
       <?php require_once 'components/bootstrap.php'?>
       <style>
           fieldset {
               margin: auto;
               margin-top: 100px;
               width: 60% ;
           }     
           
        .userImage {
            width: 200px;
            height: 200px;
        }

        .hero {
            background: rgb(2, 0, 36);
            background: linear-gradient( rgba(2, 0, 36, 1) 0%, rgba(0, 212, 255, 1) 100%);
        }

        .navbar{
            background: linear-gradient(yellow , rgb(255, 160, 122) );
        }
        .hero{
            background: linear-gradient(red , rgb(255, 160, 122) );
        }

        body{
            background-color: rgb(255, 160, 122);
            margin-bottom: 200px;
        }

        .cardbackground{
            background-color: #40E0D0;
        }
       </style>
   </head>
   <body>
   <?php require_once "navbar.php"; ?>
   <div class="container text-center d-flex flex-column bg-dark text-white" style="margin-top: 200px;">
   <h1>Animal Added!</h1>
    <div class="container w-75">
       <div class="container">
           <div class="mt-3 mb-3">
           </div>
           <div class="alert alert-<?=$class;?>" role="alert">
               <p><?php echo ($message) ?? ''; ?></p>
               <p><?php echo ($uploadError) ?? ''; ?></p>
           </div>
       </div>
    </div>
    </div>
   </body>
</html>