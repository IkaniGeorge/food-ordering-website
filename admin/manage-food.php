<?php 
    include 'partials/menu.php'
?>

<!---- Main content section starts --->
  <div class="main-content">
    <div class="wrapper">
        <h1>Manage Food</h1>

           <!---- Button to add food --->
        <br/><br/>
 
        <a class="btn-primary" href="<?= ROOT_URL ?>admin/add-food.php">Add Food</a>

        <br/><br/>

        <table class="tbl_full">
          <tr>
            <th>S.N</th>
            <th>Title</th>
            <th>Description</th>
            <th>Image</th>
            <th>Category</th>
            <th>Featured</th>
            <th>Active</th>
          </tr>

          <tr>
            <td>1.</td>
            <td>George_Ikani</td>
            <td>George Ibembem</td>
            <td>
              <a class="btn-secondary" href="">Update Admin</a>
              <a class="btn-danger" href="">Delete Admin</a>
            </td>
          </tr>


        </table>
    </div>
  </div>
   <!---- Main content section ends --->
<?php include 'partials/footer.php' ?>