<?php

    function createUser($fname, $lname, $email){

        $pdo = Database::getInstance()->getConnection();
    //check email
        $check_exist_query = 'SELECT COUNT(*) FROM `tbl_user` WHERE user_email = :useremail';
        $user_set = $pdo->prepare($check_exist_query);
        $user_set->execute(
            array(
                ':useremail'=>$email
            )
        );
    //if email count is greater than 0
         if($user_set->fetchColumn()>0){
        
            return 'Email already in use';

        } else {

    //Count any Users that have the same first and last name //
            $pdo = Database::getInstance()->getConnection();
            $check_name_query = 'SELECT COUNT(*) FROM `tbl_user` WHERE user_fname = :fname AND user_lname = :lname';
            $name_number = $pdo->prepare($check_name_query);
            $name_number->execute(
                array(
                    ':fname'=>$fname,
                    ':lname'=>$lname
                )
            );
            $user_number = $name_number->fetchColumn();
    //create username using first name, last name, and number of count //
            $username = $fname . $lname . $user_number;

    //Create random password
            $passAlphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ12334567890!@#&';
            $user_password = array();
            $length = strlen($passAlphabet) -1;
            for ($i = 0; $i < 6; $i++){
                $n = rand(0, $length);
                $user_password[] = $passAlphabet[$n];
            }
            $password = implode($user_password);
    //hash password for database
            $hashed_password = password_hash($password ,PASSWORD_DEFAULT);

    //compile all data being inputed into database //
            $data = [
                'firstname' => $fname,
                'lastname' => $lname,
                'username' => $username,
                'pass' => $hashed_password,
                'email' => $email
            ];

    //insert data into table //
            $newuser = 'INSERT INTO tbl_user (user_id, user_name, user_pass, user_fname, user_lname, user_email, user_reg) VALUES (DEFAULT,"'. $username.'","'.$hashed_password.'","'.$fname.'","'.$lname.'","'.$email.'", CURRENT_TIMESTAMP)';
            $user_build = $pdo->prepare($newuser);
            $user_build->execute($data);
        
    //email the new user the login credentials
            $to = $email;
            $subject = "Helder_J_3014_r2 Login Credentials";
            $credentials = "Username: \n $username \nPassword: \n $password";
            $link = "http://localhost/Helder_J_3014_r2/admin/user_login.php";
            $headers = "From: admin@Helder_J_3014_r2.com";
            $content = "Hello $fname $lname! \n\nYour account is ready to login at:\n $link\n\nYOUR CREDENTIALS:\n\n$credentials";

//THIS IS WHERE IT MAILS BUT I COMMENTTED IT OUT SO I WOULDN'T GET ERRORS
            // mail($to,$subject,$content,$headers);

//THIS IS THE FAKE EMAIL SO YOU CAN SEE HOW IT PRINTS OUT
            $fakeemail = "\n\nTo:$to \nSubject:$subject \n$headers\n\n$content\n\n";

            return 'User Created!'.var_dump($fakeemail);
    
        };       

    }