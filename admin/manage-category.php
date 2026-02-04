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

    if (isset($_SESSION['no-category-found']))

      echo $_SESSION['no-category-found'];
    unset($_SESSION['no-category-found']);

    if (isset($_SESSION['update']))

      echo $_SESSION['update'];
    unset($_SESSION['update']);

    if (isset($_SESSION['upload']))

      echo $_SESSION['upload'];
    unset($_SESSION['upload']);

    if (isset($_SESSION['failed-removed']))

      echo $_SESSION['failed-removed'];
    unset($_SESSION['failed-removed']);

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

        //create serial number variable an assign value as 1
        $sn = 1;

      //check whether we have data in DB or not
      if ($count > 0) {
        //we have data in DB
        //get the data and display
        while ($row = mysqli_fetch_assoc($insert_result)) {
          $id = $row['id'];
          $title = $row['title'];
          $image_name = $row['image_name'];
          $featured = $row['featured'];
          $active = $row['active'];

      ?>
          <tr>
            <td><?= $sn++ ?></td>
            <td><?= $title ?></td>
            <td>

            <?php 
                //check if whether image is available
                if($image_name!=""){
                  //display image
                  ?>
                      <img src="<?= ROOT_URL ?>images/category/<?= $image_name ?>" width="50px">
                  <?php
                }else{
                  echo "<div class='alert-mesaage error'>Image not added</div>";
                }

               ?>

            </td>
            <td><?= $featured ?></td>
            <td><?= $active ?></td>

            <td class="actions">
              <a class="btn-secondary" href="<?= ROOT_URL ?>admin/update-category.php?id=<?= $id ?>">Update Category</a>
              <a class="btn-danger" href="<?= ROOT_URL ?>admin/delete-category.php?id=<?= $id ?>&image_name=<?= $image_name ?>">Delete Category</a>
            </td>
          </tr>

        <?php
        }
      } else {
        //we do not have data
        //we'll display the message inside table
        ?>

        <tr>
          <td colspan="6">
            <div class="alert-message error">No Category Added</div>
          </td>
        </tr>

      <?php

      }


      ?>


    </table>

  </div>
</div>
<!---- Main content section ends --->

<?php include 'partials/footer.php' ?>