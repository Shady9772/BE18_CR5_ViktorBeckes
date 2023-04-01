<?php
    require_once "components/database.php";
    require_once "components/pictures.php";

    session_start();

    if(isset($_SESSION["user"])){
        header("Location: userhome.php");
    }
    if(!isset($_SESSION["adm"])&& !isset($_SESSION["user"])){
        header("Location: index.php");
    }

    function cleaninput($param){
        $clean = trim($param);
        $clean = strip_tags($clean);
        $clean = htmlspecialchars($clean);
        return $clean;
    }
    $fnameError = $lnameError = $emailError = $passError = $dateError = $first_name = $last_name = $email = $phone_number = $phoneError = $address = $addressError = "";
     
    if(isset($_POST['register'])){
        $error = false;

        $name = cleaninput($_POST['name']);
        $description = cleaninput($_POST['decription']);
        $age = cleaninput($_POST['age']);
        $size = cleaninput($_POST['size']);
        $address = cleaninput($_POST['address']);
        $picture = cleaninput($_POST['picture']);
        $vaccinated= cleaninput($_POST['vaccinated']);
        $location= cleaninput($_POST['location']);
        $status= cleaninput($_POST['status']);
        
        if(empty($name)){
            $error = true;
            $fnameError = "Please enter the animals Name";

        }elseif(strlen($name) < 3){
            $error = true;
            $fnameError = "Name must have at least 3 chars";
        }elseif(!preg_match("/^[a-zA-Z]+$/", $name)){

            $error = true;
            $fnameError = "Name must contain only letters and no spaces";

        }

        if(empty($description)){
            $error = true;
            $lnameError = "Please enter a short decription";

        }elseif(strlen($description) < 10){
            $error = true;
            $lnameError = "Descriptione must have at least 10 chars";
        }


        if(empty($age)){
            $error = true;
            $lnameError = "Please enter age of animal";

        }

        if(empty($size)){
            $error = true;
            $lnameError = "Please enter size of animal";

        }
        if(empty($vaccinated)){
            $error = true;
            $lnameError = "Please enter if animal is vaccinated or not";

        }
        if(empty($location)){
            $error = true;
            $lnameError = "Please enter where is the animal located at";

        }


    
        $picture = file_upload($_FILES["picture"]);

        if(!$error){
            $sql = "INSERT INTO `users`(`first_name`, `last_name`, `phone_number`, `address`, `password`, `date_of_birth`, `email`, `picture`, `status`) VALUES 
            ('$first_name','$last_name','$phone_number','$address','$password','$date_of_birth','$email','$picture->fileName','user')";
            $res = mysqli_query($connect, $sql);
            if($res){
                $errType = "success";
                $errMsg = "Successfully registered, you may login now!";
                $uploadError = ($picture->error != 0) ? $picture->ErrorMessage : "";
            }else{
                $errType = "danger";
                $errMsg = "error";
                $uploadError = ($picture->error != 0) ? $picture->ErrorMessage : "";
            }
        }

    }
?>

<!DOCTYPE html>
<html lang="en">
   <head>
       <meta charset="UTF-8">
       <meta name="viewport" content="width=device-width, initial-scale=1.0">
       <?php require_once 'components/bootstrap.php'?>
       <title>Add Animal</title>
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
   <h1>Add an Animal</h1>
    <div class="container w-75">

       <fieldset>
           <form action="animal_create.php" method= "post" enctype="multipart/form-data">
               <table class='table text-white'>
                   <tr>
                       <th>Name</th>
                       <td><input class='form-control bg-warning' type="text" name="name"  placeholder="Animal Name" /></td>
                   </tr>   
                   <tr>
                       <th>Age</th>
                       <td><input class='form-control bg-warning' type="text" name= "age" placeholder="Age" /></td>
                   </tr>
                   <tr>
                       <th>Picture</th>
                       <td><input class='form-control bg-warning' type="file" name="picture" /></td>
                   </tr>
                   <tr>
                       <th>Size</th>
                       <td><input class='form-control bg-warning' type="text" name="size" placeholder="Size of the animal" /></td>
                   </tr>
                   <tr>
                       <th>Vaccinated</th>
                       <td><input class='form-control bg-warning' type="text" name="vaccinated" placeholder="yes/no" /></td>
                   </tr>
                   <tr>
                       <th>Location</th>
                       <td><input class='form-control bg-warning' type="text" name="location" placeholder="Location/address" /></td>
                   </tr>
                   <tr>
                       <th>Description</th>
                       <td><input class='form-control bg-warning' type="text" name="description" placeholder="description"/></td>
                   </tr>
                   
               </table>
               <div class="container">
                        <button class='btn btn-warning' type="submit">Add Animal</button>
                       <br><br>
               </div>
           </form>
       </fieldset>


        </div>
        </div>
   </body>
</html>