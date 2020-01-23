<?php
//IF SIGN UP SUBMIT BUTTON IS CLICKED
    if (isset($_POST['signup-submit'])){
        require 'dbh.inc.php';

        $username = $_POST['uid'];
        $email = $_POST['mail'];
        $password = $_POST['pwd'];
        $passwordRepeat = $_POST['pwd-repeat'];

        if(empty($username) || empty($email) || empty($password) || empty($passwordRepeat)){
            header("Location: ../signup.php?error=emptyfields&uid=".$username."&mail=$email");
            exit();
        }else if (!filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match("/˄[a-zA-Z0-9]*$/", $username)){
            header("Location: ../signup.php?error=invalidmailuid");
            exit();
        }else if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
            header("Location: ../signup.php?error=invalidmail&uid=".$username);
            exit();
//            https://www.php.net/manual/en/function.preg-match.php
        }else if (!preg_match("/^[a-zA-Z0-9]*$/", $username)){
            header("Location: ../signup.php?error=invaliduid&mail=".$email);
            exit();
        }else if($password !== $passwordRepeat){
            header("Location: ../signup.php?error=passwordcheckuid=".$username."&mail=$email");
            exit();
        }
        else{
            $sql = "SELECT id FROM users WHERE id=?";
//            https://www.php.net/manual/en/mysqli.stmt-init.php
            $stmt = mysqli_stmt_init($conn); //THIS IS TO PROTECT FROM SQL INJECTION SO USER CAN'T INPUT SOME SQL CODE IN INPUT FIELD AND HACK IT
//            https://www.php.net/manual/en/mysqli-stmt.prepare.php
            if(!mysqli_stmt_prepare($stmt, $sql)){
                header("Location: ../signup.php?error=sqlerror");
                exit();
            }else{
//                https://www.php.net/manual/en/mysqli-stmt.bind-param.php
                mysqli_stmt_bind_param($stmt, "s", $username);
//                https://www.php.net/manual/en/mysqli-stmt.execute.php
                mysqli_stmt_execute($stmt);
//                RESULT THAT WE GOT FROM DATABASE AND STORE INTO THE VARIABLE STMT
                mysqli_stmt_store_result($stmt); // FETCH INFORMATIONS FROM THE DATABASE
                $resultCheck = mysqli_stmt_num_rows($stmt); //GET INFORMATION FROM DB TABLE RETURN AS ROWS
                if($resultCheck > 0){
                    header("Location: ../signup.php?error=usertaken&mail=".$username);
                    exit();
                }else{
                    $sql = "INSERT INTO users (username, email, pwd) VALUES (?, ?, ?)";
                    $stmt = mysqli_stmt_init($conn);
                    if(!mysqli_stmt_prepare($stmt, $sql)){
                        header("Location: ../signup.php?error=sqlerror");
                        exit();
                    }else{
//                        INSERT AND HASH THE PASSWORD ,
                        $hashedPwd = password_hash($password, PASSWORD_DEFAULT);
                        mysqli_stmt_bind_param($stmt, "sss", $username, $email, $hashedPwd);
                        mysqli_stmt_execute($stmt);
                        header("Location: ../signup.php?signup=success");
                        exit();
                    }
                }
            }
        }
        mysqli_stmt_close($stmt);
        mysqli_close($conn);


    }else{
        header("Location: ../signup.php");
        exit();
    }

