<?php
    require_once '../load.php';

    if(isset($_POST['submit'])){
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);

        if(!empty($username) && !empty($password)){
            // Do the login here
            $message = login($username, $password);
        }else{
            $message = 'Please fill out the required fields';
        }
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="../css/main.css">
    <title>Welcome to Login page</title>
</head>
<body>
    <main>
        <div class="text">
            <h1>Log In</h1>
            <?php echo !empty($message)?$message:' '; ?>
            <form action="user_login.php" method="post">
                <label>Username:</label><br>
                <input type="text" name="username" value="" /><br>

                <label>Password:</label><br>
                <input type="text" name="password" value="" /><br>

                <button name="submit">Submit</button>
            </form>
        </div>
    </main>
</body>
</html>