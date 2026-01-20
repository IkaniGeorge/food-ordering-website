<?php

use Dom\Mysql;

include 'partials/menu.php';
?>
<!---- Main content section starts --->
<div class="main-content">
  <div class="wrapper">
    <h1>Manage Admin</h1>

    <!---- Button to add admin --->
    <br /><br />

    <?php if (isset($_SESSION['add'])) : ?>

      <div class="alert-message success">
        <p>
          <?=
          $_SESSION['add'];
          unset($_SESSION['add']);
          ?>
        </p>
      </div>
      <br /><br />
    <?php endif ?>

    <?php if (isset($_SESSION['delete'])) : ?>
      <div class="alert-message success">
        <p>
          <?=
          $_SESSION['delete'];
          unset($_SESSION['delete']);
          ?>
        </p>
      </div>

      <br /><br />
    <?php endif ?>

    <?php if (isset($_SESSION['update'])) : ?>
      <div class="alert-message success">
        <p>
          <?=
          $_SESSION['update'];
          unset($_SESSION['update']);
          ?>
        </p>
      </div>

      <br /><br />
    <?php endif ?>

    <?php if (isset($_SESSION['user-not-found'])) : ?>
      <div class="alert-message error">
        <p>
          <?=
          $_SESSION['user-not-found'];
          unset($_SESSION['user-not-found']);
          ?>
        </p>
      </div>
      <br /><br />
    <?php endif ?>


    <?php if (isset($_SESSION['pwd-not-match'])) : ?>
      <div class="alert-message error">
        <p>
          <?=
          $_SESSION['pwd-not-match'];
          unset($_SESSION['pwd-not-match']);
          ?>
        </p>
      </div>
      <br /><br />
    <?php endif ?>

    <?php if (isset($_SESSION['pwd-match'])) : ?>
      <div class="alert-message success">
        <p>
          <?=
          $_SESSION['pwd-match'];
          unset($_SESSION['pwd-match']);
          ?>
        </p>
      </div>
      <br /><br />
    <?php endif ?>

    <a class="btn-primary" href="add-admin.php">Add Admin</a>

    <br/><br/>

    <table class="tbl_full">
      <tr>
        <th>S.N</th>
        <th>Full name</th>
        <th>Username</th>
        <th>Actions</th>
      </tr>

      <?php

      //Querry to get from add-admin
      $insert_into_db = "SELECT * FROM tbl_admin";
      //execute the querry
      $insert_result = mysqli_query($connection, $insert_into_db);

      //check if querry is executed
      if ($insert_result == TRUE) {

        //check rows
        $count = mysqli_num_rows($insert_result); // this is to get all the num of rows in db

        $sn = 1; //create a variable and assign a value to id

        //check the num of rows in db
        if ($count > 0) {

          while ($rows = mysqli_fetch_assoc($insert_result)) {
            //using while loop to get all the data from db
            //and while loop will run as long as we have data in db

            //get individual data
            $id = $rows['id'];
            $full_name = $rows['full_name'];
            $username = $rows['username'];

            //display the values in our table
      ?>
            <tr>
              <td><?= $sn++; ?></td>
              <td><?= $full_name;  ?></td>
              <td><?= $username; ?></td>

              <td class="actions">
                <a class="btn-primary" href="<?= ROOT_URL ?>admin/update-password.php?id=<?= $id ?>">Change Password</a>
                <a class="btn-secondary" href="<?= ROOT_URL ?>admin/update-admin.php?id=<?= $id ?>">Update Admin</a>
                <a class="btn-danger" href="<?= ROOT_URL ?>admin/delete-admin.php?id=<?= $id ?>">Delete Admin</a>

              </td>
            </tr>

      <?php
          }
        } else {
        }
      }


      ?>
    </table>
  </div>
</div>
<!---- Main content section ends --->
<?php include 'partials/footer.php'; ?>