<?php
    require_once "components/database.php";
    require_once "components/pictures.php";

    

    $id = $_GET["id"];
    $sql11 = "SELECT * FROM animals WHERE id = $id";
    $result = mysqli_query($connect,$sql11);
    $row = mysqli_fetch_assoc($result);

    if(isset($_POST["submit1"])){
        $name = $_POST["name"];
        $description = $_POST["description"];
        $age = $_POST["age"];
        $size = $_POST["size"];
        $picture = $_POST["picture"];
        $vaccinated = $_POST["vaccinated"];
        $location = $_POST["location"];
        $status = $_POST["status"];
        

        $sql1 = "UPDATE `animals` SET `name`='$name',`description`='$description',`age`='$age',`size`='$size',`picture`='$picture',`vaccinated`='$vaccinated',`location`='$location',`status`='$status' WHERE id = $id"; 
        if(mysqli_query($connect,$sql1)){
            header("Location: index.php");
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous"> <!-- bootsrap -->
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
   <h1>Edit Data</h1>
    <div class="container w-75">

       <fieldset>
           <form action="animal_create.php" method= "POST" enctype="multipart/form-data">
               <table class='table text-white'>
                   <tr>
                       <th>Name</th>
                       <td><input class='form-control bg-warning' type="text" name="name"  value="<?= $row["name"]; ?>" /></td>
                   </tr>   
                   <tr>
                       <th>Age</th>
                       <td><input class='form-control bg-warning' type="text" name="age" value="<?= $row["age"]; ?>" /></td>
                   </tr>
                   <tr>
                       <th>Picture</th>
                       <td><input class='form-control bg-warning' type="file" name="picture" /></td>
                   </tr>
                   <tr>
                       <th>Size</th>
                       <td><input class='form-control bg-warning' type="text" name="size" value="<?= $row["size"]; ?>" /></td>
                   </tr>
                   <tr>
                       <th>Vaccinated</th>
                       <td><input class='form-control bg-warning' type="text" name="vaccinated" value="<?= $row["vaccinated"]; ?>" /></td>
                   </tr>
                   <tr>
                       <th>Location</th>
                       <td><input class='form-control bg-warning' type="text" name="location" value="<?= $row["location"]; ?>" /></td>
                   </tr>
                   <tr>
                       <th>Description</th>
                       <td><input class='form-control bg-warning' type="text" name="description" value="<?= $row["description"]; ?>"/></td>
                   </tr>
                   
               </table>
               <div class="container">
               <input type="submit" class='btn btn-warning' name="submit1" value="Save Edited Data">
                
                       <br><br>
               </div>
           </form>
       </fieldset>


        </div>
        </div>
    
</body>
</html>