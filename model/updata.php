<?php
session_start();
if(isset($_SESSION["role"]) && $_SESSION['role'] == "admin"){
   include "../views/admin.php";
   include("../dbConection.php");
}else {
    echo'<script>window.location.replace("login.php");</script>';
}

include('../views/update.php');

if(isset($_GET['del'])){
    $del= $database->prepare('DELETE FROM movies WHERE ID=:id');
    $del->bindParam('id' , $_GET['del']);
    $del->execute();
    echo'<script>window.location.replace("update.php");</script>';

}
?>