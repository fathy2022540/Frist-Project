<?PHP
    session_start();
    require_once("dbConection.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sky-Cenima</title>
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/font-awesome.min.css" rel="stylesheet">
    <link href="assets/css/global.css" rel="stylesheet">
    <link href="assets/css/index.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Rajdhani&display=swap" rel="stylesheet">
    <script src="assets/js/bootstrap.bundle.min.js"></script>

</head>

<body>

    <section id="top">
        <div class="container">
            <div class="row top_1">
                <div class="col-md-3">
                    <div class="top_1l pt-1">
                        <h3 class="mb-0"><a class="text-white" href="index.html"><i
                                    class="fa fa-video-camera col_red me-1"></i> Sky Cinema</a></h3>
                    </div>
                </div>

                <div class="col-md-5">
                    <form method="get">
                        <div class="top_1m">
                            <div class="input-group">
                                <input type="text" name="moveName" class="form-control bg-black"
                                    placeholder="Search Site...">
                                <span class="input-group-btn">
                                    <button class="btn btn text-white bg_red rounded-0 border-0" name="btn"
                                        type="submit">
                                        Search</button>
                                </span>
                            </div>
                    </form>
                </div>

                <?php
                        
                        if(isset($_GET['btn'])){
                        $SEARCH = $database->prepare("SELECT * FROM movies WHERE Name =:value ");
                        $SEARCH->bindParam("value",$_GET['moveName']);
                        $SEARCH->execute();

                        foreach($SEARCH AS $data){
                        echo'<script>window.location.replace("model/book.php?moveId='.$data['ID'].'");</script>';

                        }
                        }
                    ?>
            </div>
            <div class="col-md-4">
                <div class="top_1r text-end">
                    <h6 class="mb-0">
                        <?php
							
								if (isset($_SESSION["username"])) {
									echo "
									<form method='post'>
										<button type='submit' name='logout' class='button'>Logout</button>
									</form>
									
										";
								}else{
									echo '
									<a href="model/login.php" class="button">Login</a>
									<a href="model/sign-up.php" class="button">Sign-up</a>
									';
								}
							?>

                    </h6>
                </div>
            </div>
        </div>
        </div>
    </section>

    <section id="header">
        <nav class="navbar navbar-expand-md navbar-light" id="navbar_sticky">
            <div class="container">
                <a class="navbar-brand text-white fw-bold" href="index.html"><i
                        class="fa fa-video-camera col_red me-1"></i> Sky Cinema</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mb-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </section>

    <section id="center" class="center_home">
        <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" class="active"
                    aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2"
                    aria-label="Slide 2" class="" aria-current="true"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="3"
                    aria-label="Slide 3" class="" aria-current="true"></button>

            </div>
            <div class="carousel-inner">
                <?php
                  $query = $database->prepare('SELECT * FROM movies limit 3');
                  $query->execute();
                  $data = $query->fetchAll();
                  foreach ($data as $row) { 
                    if ($row['ID'] == "1") {
                        echo '                               

                            <div class="carousel-item active">';
                    }else{
                        echo '

                            <div class="carousel-item ">
                        ';
                    }

                    echo' 

                        <img src="assets/img/'.$row['imageName'].'" class="d-block w-100" alt="...">
                        <div class="carousel-caption d-md-block">
                            <h1 class="font_60">'.$row['Name'].'</h1>
                            <h6 class="mt-3">
                                <span class="col_red me-3">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star-half-o"></i>
                                </span>
                                4.5 (Imdb) Year : 2022
                                <a class="bg_red p-2 pe-4 ps-4 ms-3 text-white d-inline-block" href="model/book.php?moveId='.$row['ID'].'">Book</a>
                            </h6>
                            <p class="mt-3">'.$row['Description'].'</p>
                            <p><span class="col_red me-1 fw-bold">Runtime:</span> '.$row['ShowTime'].'</p>
                            <h6 class="mt-4"><a class="button" href=""><i class="fa fa-play-circle align-middle me-1"></i>
                                    Watch Trailer</a></h6>
                        </div>
                        </div>
                    ';

                  }
                ?>

            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </section>

    <section id="trend" class="pt-4 pb-5">
        <div class="container">
            <div class="row trend_1">
                <div class="col-md-6 col-6">
                    <div class="trend_1l">
                        <h4 class="mb-0"><i class="fa fa-youtube-play align-middle col_red me-1"></i> Arabic <span
                                class="col_red">Movies</span></h4>
                    </div>
                </div>
            </div>
            <div class="row trend_2 mt-4">
                <div id="carouselExampleCaptions1" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <div class="trend_2i row">
                                <?php
                                 $query = $database->prepare('SELECT * FROM movies WHERE Type=:type');
                                 $ar = "ar";
                                 $query->bindParam('type', $ar);
                                 $query->execute();
                                 $data = $query->fetchAll();
                              foreach ($data as $row) {

                            echo '     <div class="col-md-3 col-6">
                            <div class="trend_2im clearfix position-relative">
                                <div class="trend_2im1 clearfix">
                                    <div class="grid">
                                        <figure class="effect-jazz mb-0">
                                            <a href="#"><img src="assets/img/'.$row['imageName'].'" class="w-100"
                                                    alt="img25"></a>
                                        </figure>
                                    </div>
                                </div>
                                <div class="trend_2im2 clearfix text-center position-absolute w-100 top-0">
                                    <span class="fs-1"><a class="col_red" href="model/book.php?moveId='.$row['ID'].'"><i
                                                class="fa fa-youtube-play"></i></a></span>
                                </div>
                            </div>
                            <div class="trend_2ilast bg_grey p-3 clearfix">
                                <h5><a class="col_red" href="model/book.php?moveId='.$row['ID'].'">'.$row['Name'].'</a></h5>
                            </div>
                        </div>
                            ';
                            
                            
                         }
                        
                    ?>

                            </div>

                        </div>
                    </div>
                </div>
            </div>

    </section>

    <section id="upcome" class="pt-4 pb-5">
        <div class="container">
            <div class="row trend_1">
                <div class="col-md-6 col-6">
                    <div class="trend_1l">
                        <h4 class="mb-0"><i class="fa fa-youtube-play align-middle col_red me-1"></i> English <span
                                class="col_red">Movies</span></h4>
                    </div>
                </div>
            </div>
            <div class="row trend_2 mt-4">
                <div id="carouselExampleCaptions2" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <div class="trend_2i row">

                                <?php
                                 $query = $database->prepare('SELECT * FROM movies WHERE Type=:type');
                                 $en = "en";
                                 $query->bindParam('type', $en);
                                 $query->execute();
                                 $data = $query->fetchAll();
                                 $result = $query->rowCount();
                                  foreach ($data as $row) {
                                echo'
                                <div class="col-md-4">
                                <div class="trend_2im clearfix position-relative">
                                    <div class="trend_2im1 clearfix">
                                        <div class="grid">
                                            <figure class="effect-jazz mb-0">
                                                <a href="#"><img src="assets/img/'.$row['imageName'].'" class="w-100"
                                                        alt="img25"></a>
                                            </figure>
                                        </div>
                                    </div>
                                    <div class="trend_2im2 clearfix text-center position-absolute w-100 top-0">
                                        <span class="fs-1"><a class="col_red" href="model/book.php?moveId='.$row['ID'].'"><i
                                                    class="fa fa-youtube-play"></i></a></span>
                                    </div>
                                </div>
                                <div class="trend_2ilast bg_grey p-3 clearfix">
                                    <h5><a class="col_red" href="model/book.php?moveId='.$row['ID'].'">'.$row['Name'].'</a></h5>
                                </div>
                                </div>
                                ';
                              
                              

                                
                              }
                              
                              
                              
                              ?>

                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </section>

    <script>
    window.onscroll = function() {
        myFunction()
    };

    var navbar_sticky = document.getElementById("navbar_sticky");
    var sticky = navbar_sticky.offsetTop;
    var navbar_height = document.querySelector('.navbar').offsetHeight;

    function myFunction() {
        if (window.pageYOffset >= sticky + navbar_height) {
            navbar_sticky.classList.add("sticky")
            document.body.style.paddingTop = navbar_height + 'px';
        } else {
            navbar_sticky.classList.remove("sticky");
            document.body.style.paddingTop = '0'
        }
    }
    </script>


</body>

</html>


<?php
	if (isset($_POST['logout'])) {
		session_destroy();

		echo'<script>window.location.replace("index.php");</script>';
		
	}
	
?>