<?php

session_start();

if(!isset($_SESSION["adm"])&& !isset($_SESSION["user"])){
    header("Location: index.php");
}
    require_once "components/database.php";

    $id = $_GET["id"];
    $sql = "SELECT * FROM animals WHERE id = $id";
    $result = mysqli_query($connect, $sql);
    $row = mysqli_fetch_assoc($result);


    if($row["status"] == "adop"){  //checks avalable status and assighns it to a $success depeding on input
        $status = "<h1 class='text-success'>Still Needs a Home</h1>"; 
    }else{
        $status = "<h1 class='text-warning'>Found a Home</h1>"; 
    }

    if($row["vaccinated"] == "yes"){  //checks avalable status and assighns it to a $success depeding on input
        $vac = "<h1 class='text-success'>Vaccinated!</h1>"; 
    }else{
        $vac = "<h1 class='text-danger'>Needs Vaccination</h1>"; 
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Details</title>
    <?php require_once 'components/bootstrap.php' ?> <!-- bootsrap -->
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
        background: linear-gradient(pink , red );
      }
      .hero{
        background: linear-gradient(red , rgb(255, 160, 122) );
      }

      .body1{
        background-color: rgb(255, 160, 122);
        margin-bottom: 200px;
      }
      .body2{
        background: linear-gradient(rgb(255, 160, 122) , yellow );
        margin-bottom: 200px;
      }

      .cardbackground{
        background-color: #40E0D0;
      }
      .cardholder{
        margin: 0;
      }
  </style>
</head>
<body class="hero">
    <?php require_once "navbar.php"; ?>
    <div class="container text-center d-flex flex-column" style="margin-top: 200px;">
    <div class="container w-75">


    <div class='card mx-auto cardbackground' style="margin-bottom: 200px;">
          <h3>Name: <?= $row["name"]; ?></h3>
          <div class="container" ><img class="h-75 w-75" src="Pictures/<?= $row["picture"]; ?>" ></div>
        
              <h1>Age: <?= $row["age"]; ?></h1>
              <h1>Size: <?= $row["size"]; ?></h1>
              <h1>Description: <?= $row["description"]; ?></h1>
              <?= $vac ?>
              <h1>Location: <?= $row["location"]; ?></h1>
              <?= $status ?>
          <br>
    
          </div>


    </div>
    </div>
    
</body>
</html>