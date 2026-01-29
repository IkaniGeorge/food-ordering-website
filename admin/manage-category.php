<?php
include 'partials/menu.php'
?>

<!---- Main content section starts --->
<div class="main-content">
  <div class="wrapper">
    <h1>Manage Category</h1>

    <!---- Button to add category--->
    <br /><br />

    <?php 
    if (isset($_SESSION['added']))

      echo $_SESSION['added'];
    unset($_SESSION['added']);

    if (isset($_SESSION['remove']))

      echo $_SESSION['remove'];
    unset($_SESSION['remove']);

    if (isset($_SESSION['delete']))

      echo $_SESSION['delete'];
    unset($_SESSION['delete']);

    ?>
    <br /><br />

    <a class="btn-primary" href="<?= ROOT_URL ?>admin/add-category.php">Add Category</a>

    <br /><br />

    <table class="tbl_full">
      <tr>
        <th>S.N</th>
        <th>Title</th>
        <th>Image</th>
        <th>Featured</th>
        <th>Active</th>
        <th>Action </th>
      </tr>

      <?php
      //Query to get form from Add Category
      $insert_into_db = "SELECT * FROM tbl_category";

      //execute the Query
      $insert_result = mysqli_query($connection, $insert_into_db);

      //check rows
      $count = mysqli_num_rows($insert_result);
      //check whether we have data in DB or not

      $sn = 1;
      if ($count > 0) {
        //we have data in DB
        //get the data and display
        while($row = mysqli_fetch_assoc($insert_result)){
          $id = $row['id'];
          $title = $row['title'];
          $image_name = $row['image_name'];
          $featured = $row['featured'];
          $active = $row['active'];

          ?>
             <tr>
               <td><?= $sn++ ?></td>
               <td><?= $title ?></td>
              <td><?= $image_name ?></td>
              <td><?= $featured ?></td>
              <td><?= $active ?></td>

              <td class="actions">
                  <a class="btn-secondary" href="<?= ROOT_URL ?>admin/update-category.php?id<?= $id ?>">Update Category</a>
                  <a class="btn-danger" href="<?= ROOT_URL ?>admin/delete-category.php?id=<?= $id ?>&image_name=<?= $image_name ?>">Delete Category</a>
              </td>
            </tr>

          <?php
        }


      }else{
        //we do not have data
        //we'll display the message inside table
        ?>

        <tr>
          <td colspan=""><div class="alert-message error">No Category Added</div></td>
        </tr>

        <?php

      }
        

      ?>
       
          
    </table>

  </div>
</div>
<!---- Main content section ends --->

<?php include 'partials/footer.php' ?>