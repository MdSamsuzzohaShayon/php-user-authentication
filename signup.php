<?php require "header.php"?>

<main class="container ">
    <h1>Signup</h1>
    <div class="row">
        <form action="includes/signup.inc.php" method="post" class="col s12">
            <div class="row">
                <div class="input-field col s6">
                    <input type="text" name="uid" placeholder="Username">
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
