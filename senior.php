<?php
require_once "components/database.php";
session_start();

if(!isset($_SESSION["adm"])&& !isset($_SESSION["user"])){
    header("Location: index.php");
}


    $sql2 = "SELECT * FROM animals"; //command for selceting my table in my database
    $result2 = mysqli_query($connect, $sql2); //combo of connect and select commands
    $layout = "";
    if(mysqli_num_rows($result2) > 0){ //checks for data
        
            while($data = mysqli_fetch_assoc($result2)){ //if there is data
                if($data["age"] >= "8"){ 
                                if($data["vaccinated"] == "yes"){  //checks avalable status and assighns it to a $success depeding on input
                                    $vacc = "<p class='text-success'>Vaccinated</p>"; 
                                }else{
                                    $vacc = "<p class='text-danger'>Not Vaccinated</p>"; 
                                }
                            $layout .= " 
                        

                        <div class='card mx-auto cardbackground'>
                        <h3>Name: {$data['name']}</h3>
                        
                        <div class='h-25 lg-h-25 ' ><img class='h-75 w-75' src='Pictures/{$data['picture']}' ></div>
          
                    
                            <p>Size: {$data['size']}</p>
                            <p>Age: {$data['age']}</p>
                            $vacc
                        <a href='animal_details.php?id={$data["id"]}' class='btn btn-primary'>Details</a>
                        <br>
                    
                        </div>

                    "; //this is how the data will be printed in the html
                        }

    }
}


mysqli_close($connect);
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Senior Animals <?php echo $row['first_name']; ?></title>
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
        background: linear-gradient(pink , red );
      }
      .hero{
        background: linear-gradient(red , rgb(255, 160, 122) );
      }

      .body1{
        background: linear-gradient(red , rgb(255, 160, 122) );
        margin-bottom: 200px;
        height: 100vh;
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

<body class="body1">
    <?php require_once "navbar.php"; ?>
    

    <div class='container fluid row row-cols-1 row-cols-md-3 row-cols-lg-4 mediacards mx-auto text-center gap-3 animaldisplay'>
    <div class='col-lg-12 d-flex justify-content-center'>
        
        </div >
             <?= $layout; ?>
        </div>




  
</body>
</html>