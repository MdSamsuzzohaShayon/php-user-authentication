<?php
include('partials/header.php');
include('config/db.php');
session_start();

// $_SESSION - An associative array containing session variables available to the current script.
//  CHECKING IS THERE ANY USERNAME VARIABLE SET IN SESSION
if(isset($_SESSION['email'])){
    header("location: index.php");
}
?>

    <!-- LOGIN FORM START-->
    <div class="ui container">
      <div class="ui header">Signin</div>
      <form class="ui form" action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
          <div class="field">
            <label for="email">Email</label>
            <input type="email" name="email" placeholder="enter your email...">
          </div>
          <div class="field">
            <label for="password">Password</label>
            <input type="password" name="password" placeholder="enter your password...">
          </div>
        <input type="submit" name="signin" class="ui tiny button green fluid" value="Login" required />
      </form>
      <?php
      if (isset($_POST['signin'])) {
          // mysqli_real_escape_string — Escapes special characters in a string for use in an SQL statement, taking into account the current charset of the connection
          $email = mysqli_real_escape_string($conn, $_POST['email']);
          $password = md5($_POST['password']);

          // VALUE OF VARCHAR VARIABLE MUST BE IN SINGLE OR DOUBLE QUATATION MARK
          $sql = "SELECT id, email, name FROM users WHERE email='$email' AND password='$password'";
          $result = mysqli_query($conn, $sql) or die("Query failed");

          if (mysqli_num_rows($result) > 0) {
              while ($row= mysqli_fetch_assoc($result)) {
                  // session_start() creates a session or resumes the current one based on a session identifier passed via a GET or POST request, or passed via a cookie.
                  session_start();
                  $_SESSION['email'] = $row['email'];
                  $_SESSION['id'] = $row['id'];
                  $_SESSION['name'] = $row['name'];

                  header("location: index.php");
              }
          } else {
              echo "<div class='alert alert-info'> Username and password didn't match </div>";
          }
      }
      ?>
    </div>
    <?php include('partials/footer.php'); ?>
    <!-- LOGIN FORM ENDS  -->
