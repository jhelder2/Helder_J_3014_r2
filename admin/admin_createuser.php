<?php
    require_once '../load.php';
    confirm_logged_in();

    if(isset($_POST['submit'])){
        $fname = trim($_POST['fname']);
        $lname = trim($_POST['lname']);
        $email = trim($_POST['email']);
    
        if(empty($fname) || empty($lname) || empty($email)){
            $message = 'Please fill required fields!';
        }else{
            //all data is good
            $message = createUser($fname, $lname, $email);
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/main.css">
    <title>Document</title>
</head>
<body>
    <main>
        <div class="text">
            <h2>Create User</h2>
            <?php echo !empty($message)? $message:''; ?>
            <form action="admin_createuser.php" method="post">

        </br>
                <label>First Name:</label>
                <input type="text" name="fname" value=""></br></br>

                <label>Last Name:</label>
                <input type="text" name="lname" value=""></br></br>

                <label>UserEmail:</label>
                <input type="text" name="email" value=""></br></br>

                <button type="submit" name="submit">Create User</button>
                </br>
                <a href="admin_logout.php">Sign Out</a>
                <a href="index.php">Home</a>
                
            </form>
        </div>
    </main>
</body>
</html>