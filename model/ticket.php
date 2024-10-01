<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>CodePen - Admit One Ticket (Aug 2021 #CodePenChallenge)</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
    <link rel="stylesheet" href="../assets/css/ticket.css">

</head>

<body>
    <!-- partial:index.partial.html -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <?php
    session_start();
        if(isset($_GET['movieId'])){
            include('../dbConection.php');
            $moveInfo = $database->prepare('SELECT * FROM movies WHERE ID=:id');
            $moveInfo->bindParam('id', $_GET['movieId']);
            $moveInfo->execute();
            $info = $moveInfo->fetchObject();
            $TicketInfo = $database->prepare('SELECT * FROM tickets WHERE Iduser=:iduser and movename=:movename
            and seat=:seat');
            $TicketInfo->bindParam('iduser', $_SESSION['id']);
            $TicketInfo->bindParam('movename', $info->Name);
            $TicketInfo->bindParam('seat', $_GET['seat']);
            $TicketInfo->execute();
            $data=$TicketInfo->fetchObject();

        }   
    ?>
    <div class="ticket">
        <div class="left">
            <div class="image">
                <div class="ticket-number">
                    <p>

                        Ticket ID:# <?php echo $data->id ?>
                    </p>
                </div>
            </div>
            <div class="ticket-info">
                <p class="date">
                    <span><?php echo $_GET['date'] ?></span>
                    <span class="june-29">JUNE 29TH</span>
                    <span>2024</span>
                </p>
                <div class="show-name">
                    <h1><?php echo $info->Name ?></h1>
                    <h2>Sky Cinema</h2>
                </div>
                <div class="time">
                    <p><?php echo $_GET['time'] ?></p>
                    <p><?php echo $_GET['seat'] ?></p>
                </div>
                <p class="location"><span>East High School</span>
                    <span class="separator"><i class="far fa-smile"></i></span><span>Salt Lake City, Utah</span>
                </p>
            </div>
        </div>
        <div class="right">
            <div class="right-info-container">
                <div class="show-name">
                    <h1><?php echo $info->Name ?></h1>
                </div>
                <div class="time">
                    <p><?php echo $_GET['time'] ?></p>
                    <p><?php echo $_GET['seat'] ?></p>
                </div>
                <div class="barcode">
                    <img src="https://external-preview.redd.it/cg8k976AV52mDvDb5jDVJABPrSZ3tpi1aXhPjgcDTbw.png?auto=webp&s=1c205ba303c1fa0370b813ea83b9e1bddb7215eb"
                        alt="QR code">
                </div>
                <p class="ticket-number">
                    #<?php echo $data->id ?>
                </p>
            </div>
        </div>
    </div>
    <script src="./script.js"></script>

</body>

</html>