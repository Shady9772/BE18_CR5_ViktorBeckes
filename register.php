<?php
    require_once "components/database.php";
    require_once "components/pictures.php";

    session_start();

    if(isset($_SESSION["user"])){
        header("Location: userhome.php");
    }
    if(isset($_SESSION["adm"])){
        header("Location: adminhome.php");
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

        $first_name = cleaninput($_POST['first_name']);
        $last_name = cleaninput($_POST['last_name']);
        $password = cleaninput($_POST['password']);
        $phone_number = cleaninput($_POST['phone_number']);
        $address = cleaninput($_POST['address']);
        $email = cleaninput($_POST['email']);
        $date_of_birth= cleaninput($_POST['date_of_birth']);
        
        if(empty($first_name)){
            $error = true;
            $fnameError = "Please enter your first name";

        }elseif(strlen($first_name) < 3){
            $error = true;
            $fnameError = "First name must have at least 3 chars";
        }elseif(!preg_match("/^[a-zA-Z]+$/", $first_name)){

            $error = true;
            $fnameError = "frst name must contain only letters and no spaces";

        }

        if(empty($last_name)){
            $error = true;
            $lnameError = "Please enter your last name";

        }elseif(strlen($last_name) < 3){
            $error = true;
            $lnameError = "last name must have at least 3 chars";
        }elseif(!preg_match("/^[a-zA-Z]+$/", $last_name)){

            $error = true;
            $lnameError = "last name must contain only letters and no spaces";
            
        }


        if(empty($phone_number)){
            $error = true;
            $phoneError = "Please enter your phone number";

        }

        if(empty($address)){
            $error = true;
            $addressError = "Please enter your address";

        }




        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $error = true;
            $emailError = "please enter valid email address";
        }else{
            $query = "SELECT email FROM users WHERE email = '$email'";
            $result = mysqli_query($connect, $query);
            if(mysqli_num_rows($result) != 0){
                $error = true;
                $emailError =  "Email registered";
            }
        }

        if(empty($date_of_birth)){
            $error = true;
            $dateError = "please enter date of birth";
        }

        if(empty($password)){
            $error = true;
            $passError = "please enter password";
        }elseif (strlen($password) < 6){
            $error = true;
            $passError = "password must have at least 6 characters";
        }

        $password = hash("sha256", $password);

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
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Page</title>
    <?php require_once "components/bootstrap.php"; ?>
</head>
<body>
    
    <?php
    if(isset($errMsg)){
        ?>
        <div class="alert alert-<?= $errType ?>" role="alert"><?= $errMsg ?><?= $uploadError ?></div>

        <?php
    }
    ?>
    








    <div class="container text-center d-flex flex-column bg-dark text-white" style="margin-top: 200px;">

    <h1>Registration form</h1>
    <div class="container w-75">

    <form method="POST" action="<?= htmlspecialchars($_SERVER['SCRIPT_NAME']); ?>" enctype="multipart/form-data">
    
        <input type="text" placeholder="Please type your first name" class="form-control" name="first_name" value="<?= $first_name ?>">
        <span class="text-danger"><?= $fnameError ?></span><br>
        <input type="text" placeholder="Please type your last name" class="form-control" name="last_name"  value="<?= $last_name ?>">
        <span class="text-danger"><?= $lnameError ?></span><br>
        <input type="email" placeholder="Please type your email" class="form-control" name="email" value="<?= $email ?>">
        <span class="text-danger"><?= $emailError ?></span><br>
        <input type="text" placeholder="Please type your phone number" class="form-control" name="phone_number" value="<?= $phone_number ?>">
        <span class="text-danger"><?= $phoneError ?></span><br>
        <input type="text" placeholder="Please type your address" class="form-control" name="address" value="<?= $address ?>">
        <span class="text-danger"><?= $addressError ?></span><br>
        <input type="password" placeholder="Please type your password" class="form-control" name="password">
        <span class="text-danger"><?= $passError ?></span><br>
        <input type="date" class="form-control" name="date_of_birth"  value="<?= $first_name ?>">
        <span class="text-danger"><?= $dateError ?></span><br>
        <input type="file" class="form-control" name="picture" >
        <br><br>
        <input type="submit" class="form-control btn btn-success" name="register" value="register" >
        <br><br>
        <a href="index.php" class="btn btn-primary">Login</a>
        <br><br>

    </form>

    </div>
    </div>
    
</body>
</html>