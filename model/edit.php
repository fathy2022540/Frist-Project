<?php
session_start();
if(isset($_SESSION["role"]) && $_SESSION['role'] == "admin"){
   include "../views/admin.php";
   include("../dbConection.php");
}else {
    echo'<script>window.location.replace("login.php");</script>';
}
if(isset($_GET['id'])){
    echo'
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Corona Admin</title>
    <!-- plugins:css -->

</head>

<body>';
    $query = $database->prepare('SELECT * FROM movies WHERE ID=:id');
    $query->bindParam('id', $_GET['id']);
    $query->execute();
    $data =$query->fetchAll();
    foreach($data as $row){
        echo '
        <form method="post" enctype="multipart/form-data">
        <div class="container-scroller" style="padding: 0 0 0 236px;">
    
            <div class="col-12 grid-margin">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Add Movies</h4>
                        <form class="form-sample">
                            <p class="card-description"> </p>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Movie Name</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="name" value="'.$row['Name'].'" class="form-control" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Description</label>
                                        <div class="col-sm-9">
                                            <input type="text" value="'.$row['Description'].'" name="description" class="form-control" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Date</label>
                                    <div class="col-sm-9">
                                        <input type="datetime-local" value="'.$row['Date'].'" class="form-control" name="date" />
                                    </div>
                                </div>
                            </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Type</label>
                            <div class="col-sm-4">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input" name="type" id="membershipRadios1"
                                            value="ar" checked> Arabic </label>
                                </div>
                            </div>
                            <div class="col-sm-5">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input"  name="type" id="membershipRadios2"
                                            value="en"> English </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <p class="card-description"></p>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">imageName</label>
                                <div class="col-sm-9">
                                    <input type="file" name="image" style="display: block;" class="form-control" />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">ReleaseDate</label>
                                <div class="col-sm-9">
                                    <input class="form-control" value="'.$row['RelaseDate'].'" type="date" name="ReleaseDate" placeholder="dd/mm/yyyy" />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">ShowTime</label>
                                <div class="col-sm-9">
                                    <input type="time" value="'.$row['ShowTime'].'" name="ShowTime" class="form-control" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="submit" value="'.$row['ID'].'"  name="saveBtn">Save</button>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
    
                            </div>
    
                        </div>
                    </div>
                </div>
    
            </div>
    
    </form>
        ';
    }
echo'
</body>

</html>
';
}

if(isset($_POST['saveBtn'])){
    $image_name_and_extension = $_FILES["image"]["name"];
$target_dir = "../assets/img/";
$target_file = $target_dir . basename($_FILES["image"]["name"]);
$tmp_name = $_FILES["image"]["tmp_name"];
move_uploaded_file($tmp_name, $target_file);
$add=$database->prepare('UPDATE movies SET Name=:name , Description=:Description , ShowTime=:showtime , Date=:date , 
RelaseDate=:RelaseDate , Type=:Type , imageName=:imageName where ID=:id');
$add->bindParam('name', $_POST['name']);
$add->bindParam('showtime', $_POST['ShowTime']);
$add->bindParam('Description', $_POST['description']);
$add->bindParam('date', $_POST['date']);
$add->bindParam('RelaseDate', $_POST['ReleaseDate']);
$add->bindParam('Type', $_POST['type']);
$add->bindParam('id', $_POST['saveBtn']);
$add->bindParam('imageName', $image_name_and_extension );
$add->execute();
echo'<script>window.location.replace("updata.php");</script>';

}

?>