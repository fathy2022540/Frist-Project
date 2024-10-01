<?php
session_start();
if(isset($_SESSION["role"]) && $_SESSION['role'] == "admin"){
   include "../views/admin.php";
   include("../dbConection.php");
}else {
    echo'<script>window.location.replace("login.php");</script>';
}

include('../views/add.html');
if(isset($_POST['addBtn'])){
$image_name_and_extension = $_FILES["image"]["name"];
list($image_name, $image_extension) = explode('.', $image_name_and_extension);
$target_dir = "../assets/img/";
$target_file = $target_dir . basename($_FILES["image"]["name"]);
$tmp_name = $_FILES["image"]["tmp_name"];
move_uploaded_file($tmp_name, $target_file);
$add=$database->prepare('INSERT INTO movies(Name , ShowTime , Description , Date , RelaseDate , imageName , Type)
VALUES(:name , :showtime ,:Description ,:date  ,:RelaseDate ,:imageName ,:Type  )');
$add->bindParam('name', $_POST['name']);
$add->bindParam('showtime', $_POST['ShowTime']);
$add->bindParam('Description', $_POST['description']);
$add->bindParam('date', $_POST['date']);
$add->bindParam('RelaseDate', $_POST['ReleaseDate']);
$add->bindParam('Type', $_POST['type']);
$add->bindParam('imageName', $image_name_and_extension );
$add->execute();




}
?>