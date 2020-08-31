<?php
// realpath — Returns canonicalized absolute pathname
// dirname — Returns a parent directory's path
// __FILE__	The full path and filename of the file with symlinks resolved. If used inside an include, the name of the included file is returned.
require_once(realpath(dirname(__FILE__) . '/../../config.php'));
class User
{

    function dashboard()
    {
        if ($this->isLogin()) {
            echo "<a class='ui button red' href='/auth_pdo/exit.php'>Exit!</a>";
        } else {
            echo "<div class='ui message negative'>Session Expired!</div>";
        }
    }



    function generateCode($length = 6)
    {
        $chars = "abcd123456789";
        $code = "";
        // strlen — Get string length
        $clean = strlen($chars) - 1;
        while (strlen($code) < $length) {
            // mt_rand — Generate a random value via the Mersenne Twister Random Number Generator
            $code .= $chars[mt_rand(0, $clean)];
        }
        return $code;
    }

    // LOGIN VALIDATION
    function checkLoginData($email, $password)
    {
        $db = new Connect;
        $result = '';
        // stripslashes — Un-quotes a quoted string  - simply outputting data straight from an HTML form.
        // htmlspecialchars — Convert special characters to HTML entities
        // md5 — Calculate the md5 hash of a string
        // trim — Strip whitespace (or other characters) from the beginning and end of a string
        if (isset($email) && isset($password)) {
            $email = stripslashes(htmlspecialchars($email));
            $password = stripslashes(htmlspecialchars(md5(md5(trim($password)))));


            if (empty($email) || empty($password)) {
                $result .= "<div class='ui negative message'>Errors: All fields are required!</div>";
            } else {
                // SELECT * FROM `users` WHERE 1
                $sql = "SELECT * FROM users WHERE email=:email AND password=:password";
                $user = $db->prepare($sql);

                $user->execute(array(
                    "email" => $email,
                    "password" => $password
                ));
                $info = $user->fetch(PDO::FETCH_ASSOC);
                if ($user->rowCount() == 0) {
                    $result .= "<div class='ui negative message'>Errors: No user found!</div>";
                } else {
                    // $result .= "<div class='ui success message'> Welcome</div>";
                    $hash = md5($this->generateCode(10));
                    $sql = "UPDATE users SET session=:hash WHERE id=:ex_user";
                    $update = $db->prepare($sql);
                    $update->execute(array(
                        "hash" => $hash,
                        'ex_user' => $info['id']
                    ));
                    // setcookie - defines a cookie to be sent along with the rest of the HTTP headers.
                    setcookie('id', $info['id'], time() + 60 * 60 * 24 * 30, "/", NULL);
                    setcookie('sess', $hash, time() + 60 * 60 * 24 * 30, "/", NULL);
                    echo ("<script> location.href= '/auth_pdo/?a=dashboard'; </script>");
                }
            }
        }
        return $result;
    }













    function loginForm()
    {
        return '
        <div class="form_block">
            <div class="ui header" id="title">Login form</div>
            <div class="body"> 
            ' . ($_POST ? $this->checkLoginData($_POST["email"], $_POST["password"]) : "") . ' 
                <form action="?a=login" method="POST" class="ui form blue" id="logform">     
                    <div class="ui field"><input type="email" name="email" placeholder="Enter your email">  </div>
                    <div class="ui field"><input type="password" name="password" placeholder="Enter your password"></div>
                    <div class="ui small buttons">
                        <input class="ui button blue" type="submit" value="Login" id="tgl"  />
                        <div class="or"></div>
                        <a class="ui button blue" href="?a=register">Register</a>
                    </div>
                    
                </form>
            </div>
        </div>
        ';
    }









    // REGISTER VALIDATION
    function checkRegisterData($f_name, $l_name, $email, $password, $password2)
    {
        $db = new Connect;
        $result = '';
        // stripslashes — Un-quotes a quoted string  - simply outputting data straight from an HTML form.
        // htmlspecialchars — Convert special characters to HTML entities
        // md5 — Calculate the md5 hash of a string
        // trim — Strip whitespace (or other characters) from the beginning and end of a string
        if (isset($f_name) && isset($l_name) && isset($email) && isset($password) && isset($password2)) {
            $f_name = stripslashes(htmlspecialchars($f_name));
            $l_name = stripslashes(htmlspecialchars($email));
            $email = stripslashes(htmlspecialchars($email));
            $password = stripslashes(htmlspecialchars(md5(md5(trim($password)))));
            $password2 = stripslashes(htmlspecialchars(md5(md5(trim($password2)))));


            if (empty($f_name) || empty($l_name) || empty($email) || empty($password2) || empty($password)) {
                $result .= "<div class='ui negative message'>Errors: All fields are required!</div>";
            } else if ($password != $password2) {
                $result .= "<div class='ui negative message'>Errors: Your password didn't match!</div>";
            } else {
                $sql = "SELECT * FROM users WHERE email=:email";
                $user = $db->prepare($sql);

                $user->execute(array(
                    "email" => $email
                ));
                $info = $user->fetch(PDO::FETCH_ASSOC);
                if ($user->rowCount() == 0) {
                    // INSERT INTO `users`(`id`, `first_name`, `last_name`, `email`, `password`, `session`) VALUES ([value-1],[value-2],[value-3],[value-4],[value-5],[value-6])
                    $sql = "INSERT INTO users(first_name, last_name, email, password) VALUES (:f_name, :l_name, :email, :password)";
                    $user = $db->prepare($sql);
                    $user->bindParam("f_name", $f_name);
                    $user->bindParam("l_name", $l_name);
                    $user->bindParam("email", $email);
                    $user->bindParam("password", $password);
                    $user->execute();
                    if (!$user) {
                        $result .= "<div class='ui negative message'>Error: All fields are required</div>";
                    } else {
                        echo ("<script> location.href= '/auth_pdo/?a=login'; </script>");
                    }
                } else {
                    $result .= "<div class='ui negative message'>Error: There is a user with this email</div>";
                }
            }
        }
        return $result;
    }

    function registerForm()
    {
        return '
        <div class="form_block">
            <div class="ui header" id="title">Register</div>
            <div class="body"> 
            ' . ($_POST ? $this->checkRegisterData(
            $_POST["f_name"],
            $_POST["l_name"],
            $_POST["email"],
            $_POST["password"],
            $_POST["password2"]
        ) : "") . ' 
                <form action="?a=register" method="POST" class="ui form blue" id="logform">     
                    <div class="ui field"><input type="text" name="f_name" placeholder="Enter your First Name">  </div>
                    <div class="ui field"><input type="text" name="l_name" placeholder="Enter your Last Name">  </div>
                    <div class="ui field"><input type="email" name="email" placeholder="Enter your email">  </div>
                    <div class="ui field"><input type="password" name="password" placeholder="Enter password"></div>
                    <div class="ui field"><input type="password" name="password2" placeholder="Repeat password"></div>
                    <div class="ui small buttons">
                        <a class="ui button blue" href="?a=register">Login</a>
                        <div class="or"></div>
                        <input class="ui button blue" type="submit" value="Register" id="tgl"  />
                    </div>
                    
                </form>
            </div>
        </div>
        ';
    }


    function isLogin()
    {
        $db = new Connect;
        if (isset($_COOKIE['id']) and isset($_COOKIE['sess'])) {
            $id = intval($_COOKIE['id']);
            $sql = "SELECT id, session FROM users WHERE id=:id_user LIMIT 1";
            $user_stmt = $db->prepare($sql);
            $user_stmt->bindParam('id_user', $id);
            $user_stmt->execute();
            $result = $user_stmt->fetch(PDO::FETCH_ASSOC);
            if (($result['session'] != $_COOKIE['sess']) || ($result['id'] != intval($_COOKIE['id']))) {
                setcookie('id', '', time() - 60 * 60 * 24 * 30, '/');
                setcookie('sess', '', time() - 60 * 60 * 24 * 30, '/');
                return false;
            } else {
                return true;
            }
        } else {
            return false;
        }
    }
}
