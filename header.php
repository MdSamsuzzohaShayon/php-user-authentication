<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login System</title>
    <link rel="stylesheet" href="css/materialize.min.css">
    <style>
        body{
            color: white;
            width: 100%;
            height: 100vh;
            background-image: url("img/bg.jpg");
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }
        .btn{
            padding: 0 !important;
            height: 50px !important;
            width: 120px !important;
            margin-top: 0 !important;
            transform: translateY(-10px);
        }
    </style>
</head>
<body>
    <header>
        <nav class="#004d40 teal darken-4">
            <div class="nav-wrapper">
<!--                <a href="#!" class="brand-logo center">Logo</a>-->
<!--                <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>-->
                <ul class="left hide-on-med-and-down">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="#">About</a></li>
                    <li><a href="#">Contact</a></li>
                    <li><a href="#">Portfolio</a></li>
                </ul>
                <ul class="right">
                    <div class="row">
                        <form action="includes/login.inc.php" class="col" method="post">

                                <div class="input-field col">
<!--                                    <label for="mailuid">Enter Your Username/E-mail</label>-->
                                    <input type="text" name="mailuid" placeholder="Username/E-mail" class="#004d40 teal darken-2">
                                </div>
                                <div class="input-field col">
<!--                                    <label for="pwd">Enter Your Password</label>-->
                                    <input type="password" name="pwd" placeholder="Your Password" class="#004d40 teal darken-2">
                                </div>
                                <div class="input-field col">
                                    <input type="submit" value="Login" class="waves-effect #004d40 teal-light darken-2 btn" name="login-submit" >
                                </div>

                        </form>
                        <a href="signup.php" class="col">Signup</a>

                        <form action="includes/logout.inc.php" class="col" method="post">
                                <input type="submit" value="Logout" class="waves-effect #004d40 teal-light darken-2 btn" name="logout-submit">
                        </form>
                    </div>
                </ul>
            </div>
        </nav>

        <br><br>
        <div class="container">

        </div>
    </header>
