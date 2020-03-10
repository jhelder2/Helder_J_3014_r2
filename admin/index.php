<?php
    require_once '../load.php';
    confirm_logged_in()
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="../css/main.css">
    <title>Dashborad</title>
</head>
<body>
    <main>
        <div class="text">
            <h2>Welcome <?php echo $_SESSION['user_fname'];echo' ';echo $_SESSION['user_lname']?>!</h2>

            <a href="admin_logout.php">Sign Out</a>
            <?php 
            if($_SESSION['user_id'] == 1){
                echo $_SESSION['admin_link'];
            }else{
                return;
                };
            ?>
        </div>
    </main>
</body>
</html>