<?php
include('partials/header.php');
include('config/db.php');
session_start();

// $_SESSION - An associative array containing session variables available to the current script.
//  CHECKING IS THERE ANY USERNAME VARIABLE SET IN SESSION
if(isset($_SESSION['email'])){
    header("location: index.php");
}


// isset — Determine if a variable is declared and is different than NULL
if (isset($_POST['signup'])) {


    // mysqli_real_escape_string — Escapes special characters in a string for use in an SQL statement, taking into account the current charset of the connection
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, md5($_POST['password'])); // md5 — Calculate the md5 hash of a string
    // $password2 = mysqli_real_escape_string($conn, md5($_POST['password2']));
    // echo $name . $email . $password;


    $sql = "SELECT email FROM users WHERE email='{$email}'";

    // mysqli_query — Performs a query on the database
    $result = mysqli_query($conn, $sql) or die("Query frield");

    // mysqli_num_rows — Gets the number of rows in a result
    if (mysqli_num_rows($result) > 0) {
        echo "<p style='color:red;text-align:center;margin: 10px 0'> Username already exist</p>";
    } else {
        $sql1 = "INSERT INTO users (name, email,password) VALUES ('$name', '$email', '$password')";
        // echo $sql1;
        if (mysqli_query($conn, $sql1)) {
            header("Location: index.php?user=added_user");
            // header("Location: users.php");
        }
    }
}

?>

<div class="ui container">
  <div class="ui header">Signup</div>
  <form class="ui form" action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
    <div class="two fields">
      <div class="field">
        <label for="name">Full Name</label>
        <input type="text" name="name" placeholder="enter your full name...">
      </div>
      <div class="field">
        <label for="email">Email</label>
        <input type="email" name="email" placeholder="enter your email...">
      </div>
    </div>
    <div class="two fields">
      <div class="field">
        <label for="password">Password</label>
        <input type="password" name="password" placeholder="set a strong password...">
      </div>
      <div class="field">
        <label for="password2">Confirm Password</label>
        <input type="password" name="password2" placeholder="enter your password2...">
      </div>
    </div>
    <input type="submit" name="signup" class="ui tiny button green fluid" value="Save" required />
  </form>
</div>
<?php include('partials/footer.php'); ?>
