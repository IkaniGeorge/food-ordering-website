<?php include 'partials/menu.php'; ?>


<?php 
//Updating

if(isset($_GET['id'])){



    $id = $_GET['id'];
    //create SQL Query to update Admin
    $sql = "SELECT * FROM tbl_category WHERE id='$id'";
    //Execute querry
    $update_result = mysqli_query($connection, $sql);

    $count = mysqli_num_rows($update_result);

    //check if the querry executes
    if($count==1){

        //getting all the data
        $row = mysqli_fetch_assoc($update_result);

        $id = $row['id'];
        $title = $row['title'];
        $current_image = $row['image_name']; 
        $featured = $row['featured'];
        $active = $row['active'];

    }else{

         //Fail to Updated Admin
        $_SESSION['no-category-found'] = "<div class='alert-message error'>Failed to Updated Category</div>";
        header('location:' . ROOT_URL . 'admin/manage-category.php');
        die();
    }

}else{
      header('location:' . ROOT_URL . 'admin/update-category.php');
        
}

?>


<div class="main-content">
    <div class="wrapper">
        <h1>Update Category</h1>
        <br/>

        <!-------Add Category form---->
        <form action="" method="POST" enctype="multipart/form-data">

            <div class="form-groupp">
                <label for="">Title</label>
                <input type="text" name="title" value="<?= $title ?>">
            </div>

            <div class="form-groupp">
                <label for="">Current Image</label>
                <p><?php 
                if($current_image !=""){
                     ?>
                      <img src="<?= ROOT_URL ?>images/category/<?= $current_image ?>" width="50px">
                  <?php
                }else{
                        echo "<div class='alert-mesaage error'>Image not added</div>";
                }
                ?>
                </p>
            </div>
            
            <div class="form-groupp">
                <label for="">New Image</label>
                <input type="file" name="image">
            </div>


            <div class="form-groupp">
                <label for="">Featured</label>
                <div class="radio-group">
                    <label><input <?php  if($featured=="Yes"){echo "checked";}?>  type="radio" name="featured" value="Yes">Yes</label>
                    <label><input <?php  if($featured=="No"){echo "checked";}?>  type="radio" name="featured" value="No">No</label>
                </div>
            </div>


            <div class="form-groupp">
                <label for="">Active</label>
                <div class="radio-group">
                    <label><input <?php  if($active=="Yes"){echo "checked";}?>  type="radio" name="active" value="Yes">Yes</label>
                    <label><input <?php  if($active=="No"){echo "checked";}?>  type="radio" name="active" value="No">No</label>
                </div>
            </div>

            <div class="form-groupp">
                <input type="submit" name="submit" value="update category" class="btn-secondary">
            </div>


        </form>
        <br /><br />
    </div>
</div>

<?php include 'partials/footer.php'; ?>