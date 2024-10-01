<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/flex.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
        integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../assets/css/privat.css">
</head>

<body style="background:#efeeed;">
    <!-- <div style="width: 98vw" class="co"> -->
    <aside>
        <h2><a href="index.php">Cpanal</a></h2>
        <br>
        <nav>
            <ul>
                <h4>MAIN</h4>
                <li><a href="../model/add.php">Add</a></li>
                <li><a href="../model/updata.php">updata</a></li>
            </ul>
            <ul>
                <h4>NOTIFICATION</h4>
                <li><a href="help.php">Support</a></li>
            </ul>
            <ul>
                <h4>SETINING</h4>
                <form style="margin: 0;" method="POST">
                    <input style="width: auto;" name="logout" type="submit" value="Logout">
                </form>
            </ul>
        </nav>
    </aside>
    <?php
	if (isset($_POST['logout'])) {
		session_destroy();

		echo'<script>window.location.replace("../index.php");</script>';
		
	}
	
?>