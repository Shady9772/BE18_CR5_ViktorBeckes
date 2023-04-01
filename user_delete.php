<?php
    require_once "components/database.php"; //importing connect to delete php

    $id = $_GET["id"]; //assign id from url
    $sql = "DELETE FROM users WHERE id = $id"; //aasign sql to delete function and ISBN

    if(mysqli_query($connect,$sql)){
        header("Location: index.php"); //goes back to the main page
    }