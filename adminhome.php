<?php

session_start();

if(!isset($_SESSION["adm"])&& !isset($_SESSION["user"])){
    header("Location: index.php");
}elseif(isset($_SESSION["user"])){
    header("Location: userhome.php");
    exit;
}


require_once "components/database.php";

$sql = "SELECT * FROM users WHERE id = '{$_SESSION["adm"]}'";
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
          $layout .= " 

          <div class='card mx-auto border-3 row cardbackground'>

          <h3>Name: {$data['name']}</h3>
         
          <div class='h-25 lg-h-25 ' ><img class='h-75 w-75' src='Pictures/{$data['picture']}' ></div>
          

              <p>Age: {$data['age']} year/s old.</p>
              $vacc
          
          <a href='animal_details.php?id={$data["id"]}' class='btn btn-primary'>Details</a>
          <a href='animal_delete.php?id={$data["id"]}' class='btn btn-danger'>Delete</a>
          <a href='animal_update.php?id={$data["id"]}' class='btn btn-success'>update</a>
          <br>
          </div>

      "; //this is how the data will be printed in the html
        }

    }else{
      $layout .= "No Result"; //if no data
  }


    //-------------------------------------------------------------------------------------------------------

    $sql3 = "SELECT * FROM users"; //command for selceting my table in my database
    $result3 = mysqli_query($connect, $sql3); //combo of connect and select commands
    $layout2 = "";

    if(mysqli_num_rows($result3) > 0){ //checks for data
        while($data1 = mysqli_fetch_assoc($result3)){ //if there is data
          if($data1["status"] == "adm"){  //checks avalable status and assighns it to a $success depeding on input
            $success = "<th scope='col' class='bg-warning' >{$data1["status"]}</th>"; 
        }else{
            $success = "<th scope='col' class='bg-secondary' >{$data1["status"]}</th>"; 
        }
          $layout2 .= " 
            <tr>                                              
            <th scope='col'>{$data1["id"]}</th>
            {$success}
            <th scope='col'>{$data1["first_name"]} {$data1["last_name"]}</th>
            <th scope='col'>{$data1["email"]}</th>
            <th scope='col'>{$data1["date_of_birth"]}</th>
            <th scope='col'><a href='details.php?id={$data1["id"]}' class='btn btn-primary'>Details</a></th>
            <th scope='col'><a href='user_delete.php?id={$data1["id"]}' class='btn btn-danger'>Ban User</a></th>
            </tr>
          "; //this is how the data will be printed in the html
        }

    }else
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
        background: linear-gradient(yellow , red );
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

    <div class='container-fluid '>

    <div class="row">

    <div class='col-lg-6 d-flex justify-content-center body1'>

    <div class='container body1 fluid row row-cols-md-3 row-cols-lg-3 mediacards mx-auto text-center gap-1'>
      <br>
    <div class='col-lg-12 col-md-12  d-flex justify-content-center'>
        <a href="senior.php" class="btn btn-primary">Senior Animals</a>
        <a href="create.php" class="btn btn-primary">Create</a>
</div >
    
    
    <?= $layout; ?>
    </div>


    </div>

      <div class='col-lg-6  body2 d-flex justify-content-center'>
      <div class="container text-center">
    <h1>Users</h1>
    <br><br>
    <table class="table table-dark">
  <thead>
    <tr class="table-primary"> <!-- primery table row -->
      <th scope="col">#</th>
      <th scope="col">Status</th>
      <th scope="col">Name</th>
      <th scope="col">Email</th>
      <th scope="col">Birth Date</th>
      <th scope="col">Details</th>
      <th scope="col">Ban User</th>
    </tr>
  </thead>
  <tbody>

        <?= $layout2; ?> <!-- this is where the data gets printeed -->

  </tbody>
</table>
      </div>



      

      </div>    
    </div>




  
</body>
</html>