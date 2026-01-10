<?php
include 'partials/menu.php';
?>

<div class="main-content">
  <div class="wrapper">
    <h1>Add Admin</h1>
    <br />

    <?php if (isset($_SESSION['add'])) : ?>

      <?=
      $_SESSION['add']; //display session message if set
      unset($_SESSION['add']); // remove session message
      ?>
      <br /><br />
    <?php endif ?>
    <form class="form-container" method="POST">

      <div class="form-group">
        <label for="fullname">Full Name</label>
        <input type="text" name="full_name" placeholder="Enter your full name" required>
      </div>

      <div class="form-group">
        <label for="username">Username</label>
        <input type="text" name="username" placeholder="Choose a username" required>
      </div>

      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" name="password" placeholder="Enter your password" required>
      </div>

      <button type="submit" name="submit" class="submit-btn">Add Admin</button>
    </form>

  </div>
</div>

<?php include 'partials/footer.php'; ?>

<?php
//1.Get data from form
if (isset($_POST['submit'])) {
  $full_name = $_POST['full_name'];
  $username = $_POST['username'];
  $password = md5($_POST['password']); // Decrypt password with md5

  //2. SQL to save data into db
  $insert_into_db = "INSERT INTO tbl_admin SET full_name='$full_name',
 username='$username', password='$password'";

  //3. executing querry and saving data into db
  $insert_result = mysqli_query($connection, $insert_into_db);

  //4. check if the data is inserted and display message
  if ($insert_result == TRUE) {

    //Create session variable to display message
    $_SESSION['add'] = "Admin added successfully";
    header("location:" . ROOT_URL . 'admin/manage-admin.php');
    //die();

  } else {
    $_SESSION['add'] = 'Fail to add Admin';
    header('location:' . ROOT_URL . 'admin/add-admin.php');
    //die();
  }
}

?>