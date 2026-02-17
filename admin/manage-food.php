<?php
include 'partials/menu.php'
?>

<!---- Main content section starts --->
<div class="main-content">
  <div class="wrapper">
    <h1>Manage Food</h1>
    <br /><br />

    <a class="btn-primary" href="<?= ROOT_URL ?>admin/add-food.php">Add Food</a>

    <br /><br />
    <?php
          if (isset($_SESSION['added']))
            echo  $_SESSION['added'];
          unset($_SESSION['added']);

          if (isset($_SESSION['remove']))
            echo  $_SESSION['remove'];
          unset($_SESSION['remove']);

          if (isset($_SESSION['delete']))
            echo  $_SESSION['delete'];
          unset($_SESSION['delete']);

          if (isset($_SESSION['unathaurize']))
            echo  $_SESSION['unathaurize'];
          unset($_SESSION['unathaurize']);

          if (isset($_SESSION['failed-remove']))
            echo  $_SESSION['failed-remove'];
          unset($_SESSION['failed-remove']);

          if (isset($_SESSION['update']))
            echo  $_SESSION['update'];
          unset($_SESSION['update']);

    ?>

    <table class="tbl_full">
      <tr>
        <th>S.N</th>
        <th>Title</th>
        <th>Price</th>
        <th>Image</th>
        <th>Featured</th>
        <th>Active</th>
        <th>Actions</th>
      </tr>
      <?php
      //Create sql query to get all the food 
      $sql = "SELECT * FROM tbl_food";

      //Execute the query
      $res = mysqli_query($connection, $sql);
      //Count rows to check if we have food or not
      $count = mysqli_num_rows($res);

      //Create serial number variable and set default value
      $sn = 1;

      if ($count > 0) {
        //we have food in database
        //Get the food from DB and display
        while ($row = mysqli_fetch_assoc($res)) {
          //get the values for individual column
          $id = $row['id'];
          $title = $row['title'];
          $price = $row['price'];
          $image_name = $row['image_name'];
          $featured = $row['featured'];
          $active = $row['active'];

      ?>
          <tr>
            <td><?= $sn++ ?></td>
            <td><?= $title ?></td>
            <td><?= $price ?></td>
            <td> <?php
                  //check if whether image is available
                  if ($image_name != "") {
                    //display image
                  ?>
                <img src="<?= ROOT_URL ?>images/food/<?= $image_name ?>" width="30px">
              <?php
                  } else {
                    echo "<div class='alert-mesaage error'>Image not added</div>";
                  }

              ?>
            </td>
            <td><?= $featured ?></td>
            <td><?= $active ?></td>

            <td class="actions">
              <a class="btn-secondary" href="<?= ROOT_URL ?>admin/update-food.php?id=<?= $id ?>">Update Food</a>
              <a class="btn-danger" href="<?= ROOT_URL ?>admin/delete-food.php?id=<?= $id ?>&image_name=<?= $image_name ?>">Delete Food</a>
            </td>
          </tr>
      <?php
        }
      } else {
        //Food not added to database
        echo "<tr> <td colspan='7' class='alert-message error'>Food not Added Yet</td> </tr>";
      }

      ?>

    </table>
  </div>
</div>
<!---- Main content section ends --->
<?php include 'partials/footer.php' ?>