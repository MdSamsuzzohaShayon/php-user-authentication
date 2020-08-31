<?php include('partials/header.php');
// echo $conn;
?>

<div class="ui container">
  <?php
       include("config/db.php");

       $sql = "SELECT * FROM users";
       $result = mysqli_query($conn, $sql) or die("Query failed");
       // mysqli_num_rows — Gets the number of rows in a result
       if (mysqli_num_rows($result) > 0) {
       ?>
       <div class="ui header">
         Users list
       </div>
  <table class="ui blue table">
    <thead>
      <th>SL</th>
      <th>Name</th>
      <th>Email</th>
      <th>Action</th>

    </thead>
    <tbody>
      <?php
                            //   mysqli_fetch_assoc — Fetch a result row as an associative array
          while ($row = mysqli_fetch_assoc($result)) {
          ?>
              <tr>
                  <td class='id'><?php echo $row['id']; ?></td>
                  <td><?php echo $row['name'] ; ?></td>
                  <td><?php echo $row['email']; ?></td>
                  <td >
                    <a class='ui button blue' href='update-user.php?id=<?php echo $row["id"] ?>'>Edit</a>
                    <a class='ui button red' href='delete-user.php?id=<?php echo $row["id"] ?>'>Delete</a>
                  </td>
              </tr>
          <?php } ?>
    </tbody>
  </table>
  <?php } ?>
</div>

<?php include('partials/footer.php'); ?>
