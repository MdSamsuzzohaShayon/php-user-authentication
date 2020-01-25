<?php require "header.php"?>

<main class="container ">
    <h1>Signup</h1>
    <?php
        if(isset($_GET['error'])){
            if ($_GET['error']== "emptyfields"){
                echo '<p class="card-panel #d32f2f red darken-2">Fill all the forms</p>';
            }else if($_GET['error']== "invalidmailuid"){
                echo '<p class="card-panel #d32f2f red darken-2">Invalid user name and e-mail</p>';
            }else if($_GET['error']== "invalidmail"){
                echo '<p class="card-panel #d32f2f red darken-2">Invalid E-mail</p>';
            }else if($_GET['error']== "invaliduidl"){
                echo '<p class="card-panel #d32f2f red darken-2">Invalid Username</p>';
            }else if($_GET['error']== "passwordcheck"){
                echo '<p class="card-panel #d32f2f red darken-2">Your password did not match</p>';
            }else if($_GET['error']== "usertaken"){
                echo '<p class="card-panel #d32f2f red darken-2">User is already taken</p>';
            }
        }else if($_GET['signup'] == 'success'){
            echo '<p class="card-panel #388e3c green darken-2">Sign up successful </p>';
        }
    ?>
    <div class="row">
        <form action="includes/signup.inc.php" method="post" class="col s12">
            <div class="row">
                <div class="input-field col s6">
                    <input type="text" name="uid" placeholder="Username" >
                </div>
                <div class="input-field col s6">
                    <input type="email" name="mail" placeholder="E-mail">
                </div>
            </div>
            <div class="row">
                <div class="input-field col s6">
                    <input type="password" name="pwd" placeholder="Password">
                </div>
                <div class="input-field col s6">
                    <input type="password" name="pwd-repeat" placeholder="Repeat Password">
                </div>
            </div>




            <!--        HERE I MADE THE MISTAKE IN PREVIOUS PROJECT. SUBMIT INPUT FIELD SHOULD HAVE A NAME-->
            <input type="submit" value="Signup" name="signup-submit" class="btn #004d40 teal darken-4">
        </form>
    </div>
</main>

<?php require "footer.php" ?>
