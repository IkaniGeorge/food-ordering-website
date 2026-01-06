<?php 
    include 'partials/menu.php';
?>
  <!---- Main content section starts --->
  <div class="main-content">
    <div class="wrapper">
        <h1>Manage Admin</h1>

        <!---- Button to add admin --->
        <br/><br/>

      <?php if(isset($_SESSION['add'])) {

          echo $_SESSION['add'];

      }
   ?>

        
        <a class="btn-primary" href="add-admin.php">Add Admin</a>

        <br/><br/>

        <table class="tbl_full">
          <tr>
            <th>S.N</th>
            <th>Full name</th>
            <th>Username</th>
            <th>Actions</th>
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

          <tr>
            <td>2.</td>
            <td>George_Ikani</td>
            <td>George Ibembem</td>
            <td>
              <a class="btn-secondary" href="">Update Admin</a>
              <a class="btn-danger" href="">Delete Admin</a>
            </td>
          </tr>

          <tr>
            <td>3.</td>
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
<?php include 'partials/footer.php'; ?>
