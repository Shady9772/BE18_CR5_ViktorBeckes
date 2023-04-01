<?php
require_once "components/database.php";
session_start();
if(isset($_SESSION["adm"])){
    header("Location: adminhome.php");
}elseif(!isset($_SESSION["user"])){
    header("Location: index.php");
}

$sql = "SELECT * FROM users WHERE id = {$_SESSION["user"]}";
$result = mysqli_query($connect, $sql);
$row = mysqli_fetch_assoc($result);

    $sql2 = "SELECT * FROM animals"; //command for selceting my table in my database
    $result2 = mysqli_query($connect, $sql2); //combo of connect and select commands
    $layout = "";

    if(mysqli_num_rows($result2) > 0){ //checks for data
        while($data = mysqli_fetch_assoc($result2)){ //if there is data
            if($data["vaccinated"] == "yes"){  //checks avalable status and assighns it to a $success depeding on input
                $vacc = "<p class='text-success'>Vaccinated</p>"; 
            }else{
                $vacc = "<p class='text-danger'>Not Vaccinated</p>"; 
            }
            if($data["status"] == "adop"){  //checks avalable status and assighns it to a $success depeding on input
              $adopted = "<h1 class='text-success'>Adopted!</h1>"; 
            }else{
              $adopted = "<h1 class='text-danger'>Needs a Home</h1>"; 
          }
          $layout .= " 

          

          <div class='card mx-auto cardbackground'>
          <h3>Name: {$data['name']}</h3>
          
          <div class='h-25 lg-h-25 ' ><img class='h-75 w-75' src='Pictures/{$data['picture']}' ></div>
          
    
              <p>Size: {$data['size']}</p>
              <p>Age: {$data['age']}</p>
              $vacc
              $adopted
          <a href='animal_details.php?id={$data["id"]}' class='btn btn-primary'>Details</a>
          <br>
    
          </div>

      "; //this is how the data will be printed in the html
        }

    }

mysqli_close($connect);
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Welcome - <?php echo $row['first_name']; ?></title>
  <?php require_once 'components/bootstrap.php' ?>
  <style>
      .userImage {
          width: 200px;
          height: 200px;
      }

      .hero {
          background: rgb(2, 0, 36);
          background: linear-gradient( rgba(2, 0, 36, 1) 0%, rgba(0, 212, 255, 1) 100%);
      }

      .navbar{
        background: linear-gradient(black , red );
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
    <div class="hero d-flex justify-content-end">
      <div class="container w-25"></div>
      <div class="container w-25"><img class="userImage rounded-circle" src="Pictures/<?php echo $row['picture']; ?>" ></div>
      <div class="container">
        <h1><?= $row['first_name']. " " . $row['last_name']; ?></h1>
        <h1><?= $row['email'] ?></h1>
        <a href="logout.php?logout" class="btn btn-danger">Sign Out</a>
        <a class="btn btn-primary" href="index.php">Update your profile</a>
    </div>
    </div>
    

    <div class='container fluid row row-cols-1 row-cols-md-3 row-cols-lg-4 mediacards mx-auto text-center gap-3 animaldisplay'>
    <div class='col-lg-12  d-flex justify-content-center'>
        <a href="senior.php" class="btn btn-primary">Senior Animals</a>
        </div>
             <?= $layout; ?>
        </div>




  
</body>
</html>