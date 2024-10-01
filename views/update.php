<?php
    $move = $database->prepare("SELECT * FROM movies ");
    $move->execute();
    $data = $move->fetchAll();


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>DarkPan - Bootstrap 5 Admin Template</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Roboto:wght@500;700&display=swap"
        rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="../assets/css/update.css" rel="stylesheet">
</head>

<body>
    <div class="container-fluid pt-4 px-4" style="max-width: 900px;     padding-right: 0;">
        <div class="bg-secondary text-center rounded p-4">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h6 class="mb-0">Movies</h6>
            </div>
            <div class="table-responsive">
                <table class="table text-start align-middle table-bordered table-hover mb-0">
                    <thead>
                        <tr class="text-white">

                            <th scope="col">Movie ID</th>
                            <th scope="col">Movie name</th>
                            <th scope="col">ShowTimes</th>
                            <th scope="col">Description</th>
                            <th scope="col">Dates</th>
                            <th scope="col">RelaseDate</th>
                            <th scope="col">Image</th>
                            <th scope="col">Procedures</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            foreach($data as $row){
                                echo'
                                    <tr>

                                        <td>'.$row['ID'].'</td>
                                        <td>'.$row['Name'].'</td>
                                        <td>'.$row['ShowTime'].'</td>
                                        <td>'.$row['Description'].'</td>
                                        <td>'.$row['Date'].'</td>
                                        <td>'.$row['RelaseDate'].'</td>
                                        <td> '.$row['imageName'].'</td>
                                        <td>
                                        <form method="get">
                                            <a class="btn btn-sm btn-primary" href="../model/edit.php?id='.$row['ID'].'">Edit</a>
                                            <button class="btn btn-sm btn-primary" value="'.$row['ID'].'" name="del">Delete</button>
                                        </td>
                                    </tr>
                                ';
                            }
                        
                        ?>


                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>