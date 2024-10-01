<?php
session_start();   
if (isset($_SESSION["username"])) {

if(isset($_GET['moveId'])){
    
    require_once("../dbConection.php");
    echo'
    <head>
    <link rel="stylesheet" href="../assets/css/index.css">
    <link href="../assets/css/global.css" rel="stylesheet">
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/css/font-awesome.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Rajdhani&display=swap" rel="stylesheet">
    <script src="../assets/js/bootstrap.bundle.min.js"></script>

  </head>

  <section id="center" class="center_home">
        <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
    ';
    $move = $_GET["moveId"];
    $query = $database->prepare('SELECT * FROM movies WHERE ID=:moveId');
    $query->bindparam( 'moveId',$move);
    $query->execute();
    $data = $query->fetchAll();
    foreach ($data as $row){
 echo'
 <div class="carousel-item active">
     <img src="../assets/img/'.$row['imageName'].'" class="d-block w-100" alt="...">
     <div class="carousel-caption d-md-block" style="bottom: 0rem;  left: 0;">
         <h1 class="font_60" > '.$row['Name'].'</h1>
         <h6 class="mt-3">
             <span class="col_red me-3">
                 <i class="fa fa-star"></i>
                 <i class="fa fa-star"></i>
                 <i class="fa fa-star"></i>
                 <i class="fa fa-star"></i>
                 <i class="fa fa-star-half-o"></i>
             </span>
             4.5 (Imdb) Year : 2022
         </h6>
         <p class="mt-3" style="width: auto;">'.$row['Description'].'</p>
         <p><span class="col_red me-1 fw-bold">Runtime:</span> '.$row['ShowTime'].'</p>
         <h6 class="mt-4" ><a class="button" href="#"><i class="fa fa-play-circle align-middle me-1"></i> Watch
                 Trailer</a></h6>
     </div>
 </div>
</div>
 ';

}

echo '
</div>
</div>
</section>
';
include('../views/book.php');

}
}else{
    echo'<script>window.location.replace("login.php");</script>';

}

?>