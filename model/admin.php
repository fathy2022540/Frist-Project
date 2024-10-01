<?php
session_start();
if(isset($_SESSION["role"]) && $_SESSION['role'] == "admin"){
   include "../views/admin.php";
}else {
    echo'<script>window.location.replace("login.php");</script>';
}
?>