<?php
include("config/db.php");
session_status() === PHP_SESSION_ACTIVE ?: session_start();

// $_SESSION - An associative array containing session variables available to the current script.
//  CHECKING IS THERE ANY USERNAME VARIABLE SET IN SESSION
if (!isset($_SESSION['email'])) {
    header("location: signin.php");
}
 ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Authentication</title>
    <link rel="stylesheet" href="css/semantic.min.css" />
  </head>
  <body>
    <!-- MENU START -->
    <div class="ui stackable menu inverted green">
      <div class="ui container">
        <div class="item"> <a href="#">Home</a> </div>
        <div class="item"> <a href="#">About</a> </div>
        <div class="item"> <a href="#">Contact</a> </div>
        <div class="menu right">
          <div class="item"> <a href="<?php echo "./signout.php"; ?>">Logout</a> </div>
        </div>
      </div>
    </div>
    <!-- MENU ENDS -->
