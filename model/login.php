<?php
    session_start();
    include("../views/login.html");
    if (isset($_SESSION['username']) ){   
        echo'<script>window.location.replace("index.php");</script>';
    }
?>


<?php
    if ( isset($_POST["login"]) ){
        require("../dbConection.php");
        $username = $_POST["username"];
        $password = $_POST["password"];
        $query = $database->prepare("SELECT * FROM users WHERE userName=:username AND password=:password");
        $query->bindparam("username", $username);
        $query->bindparam("password", $password);
        $query->execute() ;
        $result= $query->rowCount() ;
        $data = $query->fetchObject() ;
       if ($result > 0){
        $_SESSION["username"] = $username;
        $_SESSION["id"] = $data->id;
        if ($data->role == 1){
            $_SESSION["role"] = "admin";
            echo'<script>window.location.replace("admin.php");</script>';

        }else{
            $_SESSION["role"] = "client";
            echo'<script>window.location.replace("../index.php");</script>';
        }
        
       }else{  
        echo'<script>window.location.replace("login.php");</script>';

       }


    } ;


    
?>