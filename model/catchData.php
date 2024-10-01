<?php
    session_start();
if(isset($_POST['bookNow'])){
    include('../dbConection.php');
    $moveInfo = $database->prepare('SELECT * FROM movies WHERE ID=:id');
    $moveInfo->bindParam('id', $_POST['bookNow']);
    $moveInfo->execute();
    $info = $moveInfo->fetchObject();
    $query = $database->prepare('INSERT INTO tickets(movename, time,day,iduser,username,seat,price)
    VALUES(:movename, :time , :day , :iduser , :username , :seat , :price)');
    $query->bindParam('movename', $info->Name);
    $query->bindParam('time', $_POST['time']);
    $query->bindParam('day', $_POST['date']);
    $query->bindParam('iduser', $_SESSION['id']);
    $query->bindParam('username', $_SESSION['username']);
    $query->bindParam('seat', $_POST['seat']);
    $query->bindParam('price', $_POST['price']);
    $query->execute();
    $addSeats = $database->prepare('INSERT INTO seats(Number , IdMovie) VALUE(:number , :idmovie)');
    $addSeats->bindParam('number', $_POST['seat']);
    $addSeats->bindParam('idmovie', $_POST['bookNow']);
    $addSeats->execute();
    echo 'ok'; 
}

?>