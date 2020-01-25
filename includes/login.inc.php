<?php

    if (isset($_POST['login-submit'])){

        require "dbh.inc.php";

        $mailuser = $_POST['mailuser'] ;
        $password = $_POST['pwd'] ;
        if(empty($mailuser) || empty($password)){
            header("Location: ../index.php?error=emptyFields");
            exit();
        }else{
//            WE CAN DO ERROR HANDLING HERE
//            CHECKING FOR USERNAME AND EMAIL IS IN THE DB OR NOT
            $sql = "SELECT * FROM users WHERE username=? OR email=?";
            $stmt = mysqli_stmt_init($conn);
            if(!mysqli_stmt_prepare($stmt, $sql)){
                header("Location: ../index.php?error=sqlerror");
                exit();
            }else{
                mysqli_stmt_bind_param($stmt, 'ss', $mailuser, $mailuser);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
                if($row = mysqli_fetch_assoc($result)){
                    $pwdCheck = password_verify($password, $row['pwd']); /// CHECKING USER ENTER PASSWORD WITH DATABASE HASH PASSWORD
                    // CHECK PASSWORD IS WRONG OR RIGHT
                    if($pwdCheck == false){
                        header("Location: ../index.php?error=wrongpwd");
                        exit();
                    }else if($pwdCheck == true){
                        session_start(); // IN ORDER TO CHECK GLOBAL VARIABLE AVAILABLE OR NOT ... STORE A GLOBAL VARIABLE THAT IS START
                        $_SESSION['userId'] = $row['id'];
                        $_SESSION['userName'] = $row['username'];
                        header("Location: ../index.php?login=success");
                        exit();

                    }else{
                        header("Location: ../index.php?error=wrongpwd");
                        exit();
                    }
                }else{
                    header("Location: ../index.php?error=nouser");
                    exit();
                }
            }
        }


    }else{
        header("Location: ../index.php");
        exit();
    }
