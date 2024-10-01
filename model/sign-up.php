<?php 
    session_start();
    include("../views/sign-up.html");
    if (isset($_SESSION['username']) ){   
        echo'<script>window.location.replace("index.php");</script>';
    }
?>


<?php
        if ( isset($_POST["signUp"]) ){
            require("../dbConection.php");
            $username = $_POST["username"];
            $password = $_POST["password"];
            $name = $_POST["name"];
            $phoneNumber = $_POST["phoneNumber"];
            $query = $database->prepare("INSERT INTO users( name, userName, password, phoneNumber)
             VALUES (:name,:username,:password,:phoneNumber)");
            $query->bindparam("username", $username);
            $query->bindparam("password", $password);
            $query->bindparam("name", $name);
            $query->bindparam("phoneNumber", $phoneNumber);
            $query->execute() ;
            $_SESSION["username"] = $username;
            $_SESSION["password"] = $password;
            echo'<script>window.location.replace("../index.php");</script>';
    
    
        } ;
?>