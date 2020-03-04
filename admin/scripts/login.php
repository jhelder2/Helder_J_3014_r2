<?php 
function login($username, $password){

    $pdo = Database::getInstance()->getConnection();

//check if username exists
    $check_exist_query = 'SELECT COUNT(*) FROM `tbl_user` WHERE user_name = :username';
    $user_set = $pdo->prepare($check_exist_query);
    $user_set->execute(
        array(
            ':username'=>$username
        )
    );
//if username exist then
    if($user_set->fetchColumn()>0){

//IF USER IS NOT ADMIN//
        if($username != 'admin'){

//Verify if userinput password matches Hashed password//
            $get_the_hash = 'SELECT user_pass FROM `tbl_user` WHERE user_name = :username';
            $user_hash = $pdo->prepare($get_the_hash);
            $user_hash->execute(
                array(
                ':username'=>$username
                )
            );
            $hashedword = $user_hash->fetchColumn();
    //if it does match then
            if(password_verify($password, $hashedword)) {
                $new_password = $hashedword;
            }else{
                return 'Wrong Passcode';
            };

    //Check if pass/user match
            $check_exist_query = 'SELECT * FROM `tbl_user` WHERE user_name = :username';
            $check_exist_query .=' AND user_pass=:password';
            $user_match = $pdo->prepare($check_exist_query);
            $user_match->execute(
                array(
                    ':username'=>$username,
                    ':password'=>$new_password
                )
            );
    //if match
            while($founduser = $user_match->fetch(PDO::FETCH_ASSOC)){
                $id = $founduser['user_id'];
                $_SESSION['user_id'] = $id;
                $_SESSION['user_name'] = $founduser['user_fname'];
            }

            if(isset($id)){
                redirect_to('index.php');
            }
//IF ADMIN//
        } else {
            $check_exist_query = 'SELECT * FROM `tbl_user` WHERE user_name = :username';
            $check_exist_query .=' AND user_pass=:password';
            $user_match = $pdo->prepare($check_exist_query);
            $user_match->execute(
                array(
                    ':username'=>$username,
                    ':password'=>$password
                )
            );
    //if match
            while($founduser = $user_match->fetch(PDO::FETCH_ASSOC)){
                $id = $founduser['user_id'];
                $_SESSION['user_id'] = $id;
                $_SESSION['user_name'] = $founduser['user_fname'];
            }

            if(isset($id)){
                redirect_to('admin_createuser.php');
            }else{
                return 'Wrong pass';
            }
        }
    }else{
        return 'User does not exist!';
    }
    
}

function confirm_logged_in(){
    if(!isset($_SESSION['user_id'])){
        redirect_to('user_login.php');
    }
}

function logout(){
    session_destroy();
    redirect_to('user_login.php');
}