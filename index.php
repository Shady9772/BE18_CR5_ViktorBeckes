<?php 
    session_start();

    if(isset($_SESSION["user"])){
        header("Location: userhome.php");
    }
    if(isset($_SESSION["adm"])){
        header("Location: adminhome.php");
    }

    require_once "components/database.php";
    function cleaninput($param){
        $clean = trim($param);
        $clean = strip_tags($clean);
        $clean = htmlspecialchars($clean);
        return $clean;
    }

    $emailError = $email = $passError = "";

    if(isset($_POST["btn-login"])){
        $error = false;
        $email = cleaninput($_POST["email"]);
        $password = cleaninput($_POST["password"]);

        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $error = true;
            $emailError = "please enter valid email address";
        }

        if (empty($password)){
            $error = true;
            $passError = "Please enter your password ";
        }
        if(!$error){
            $password = hash("sha256", $password);
            $sql = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
            $result = mysqli_query($connect, $sql);
            $count = mysqli_num_rows($result);
            $row = mysqli_fetch_assoc($result);
            if($count == 1){  //checks if you an user or adm
                if($row["status"] == "adm"){
                    $_SESSION["adm"] = $row["id"];
                    header("Location: adminhome.php");
                }else{
                    $_SESSION["user"] = $row["id"];
                    header("Location: userhome.php");
                }
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
    <title>Login</title>
    <?php require_once "components/bootstrap.php"; ?>
</head>
<body>




<div class="container text-center d-flex flex-column bg-dark text-white" style="margin-top: 200px;">
<h2>Login</h2>
<div class="container w-75">

    
<form method="POST" class="bg-dark" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off">
          
          <?php
          if (isset($errMSG)) {
              echo $errMSG;
          }
          ?>
          <input type="email" autocomplete="off" name="email" class="form-control" placeholder="Your Email" value="<?php echo $email; ?>" maxlength="40" />
          <span class="text-danger"><?php echo $emailError; ?></span><br>
          <input type="password" name="password" class="form-control" placeholder="Your Password" maxlength="15" />
          <span class="text-danger"><?php echo $passError; ?></span><br>
          <button class="btn btn-block btn-primary" type="submit" name="btn-login">Login</button>
          <a href="register.php" class="btn btn-danger">Not Registered</a>
          <br><br>
      </form>

</div>
</div>


    
</body>
</html>