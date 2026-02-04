<?php include 'partials/menu.php'; ?>


<?php
//Updating

if (isset($_GET['id'])) {



    $id = $_GET['id'];
    //create SQL Query to update Admin
    $sql = "SELECT * FROM tbl_category WHERE id='$id'";
    //Execute querry
    $update_result = mysqli_query($connection, $sql);

    $count = mysqli_num_rows($update_result);

    //check if the querry executes
    if ($count == 1) {

        //getting all the data
        $row = mysqli_fetch_assoc($update_result);

        $id = $row['id'];
        $title = $row['title'];
        $current_image = $row['image_name'];
        $featured = $row['featured'];
        $active = $row['active'];
    } else {

        //Fail to Updated Admin
        $_SESSION['no-category-found'] = "<div class='alert-message error'>Failed to Updated Category</div>";
        header('location:' . ROOT_URL . 'admin/manage-category.php');
        die();
    }
} else {
    header('location:' . ROOT_URL . 'admin/update-category.php');
}

?>


<div class="main-content">
    <div class="wrapper">
        <h1>Update Category</h1>
        <br />

        <!-------Add Category form---->
        <form action="" method="POST" enctype="multipart/form-data">

            <div class="form-groupp">
                <label for="">Title</label>
                <input type="text" name="title" value="<?= $title ?>">
            </div>

            <div class="form-groupp">
                <label for="">Current Image</label>
                <p><?php
                    if ($current_image != "") {
                    ?>
                        <img src="<?= ROOT_URL ?>images/category/<?= $current_image ?>" width="50px">
                    <?php
                    } else {
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
                    <label><input <?php if ($featured == "Yes") {
                                        echo "checked";
                                    } ?> type="radio" name="featured" value="Yes">Yes</label>
                    <label><input <?php if ($featured == "No") {
                                        echo "checked";
                                    } ?> type="radio" name="featured" value="No">No</label>
                </div>
            </div>


            <div class="form-groupp">
                <label for="">Active</label>
                <div class="radio-group">
                    <label><input <?php if ($active == "Yes") {
                                        echo "checked";
                                    } ?> type="radio" name="active" value="Yes">Yes</label>
                    <label><input <?php if ($active == "No") {
                                        echo "checked";
                                    } ?> type="radio" name="active" value="No">No</label>
                </div>
            </div>

            <div class="form-groupp">
                <input type="hidden" name="current_image" value="<?= $current_image ?>">
                <input type="hidden" name="id" value="<?= $id ?>">
                <input type="submit" name="submit" value="update category" class="btn-secondary">
            </div>


        </form>

        <?php

        if (isset($_POST['submit'])) {

            //Get all the values from our form
            $id = $_POST['id'];
            $title = $_POST['title'];
            $current_image = $_POST['current_image'];
            $featured = $_POST['featured'];
            $active = $_POST['active'];

            //2. Update new image if selected 
            //Check whether the image is selected or not
            if (isset($_FILES['image']['name'])) {

                //Get the image details
                $image_name = $_FILES['image']['name'];

                //check if image is available or not
                if ($image_name != "") {

                    //Image Available
                    //A. Upload the new image

                    //Auto renaming image to avoid naming conflict
                    //Getting image extension like jpg, jpeg, png, heic
                    $extention = end(explode('.', $image_name));

                    //Rename the image
                    $image_name = "Food_Category_" . rand(000, 999) . '.' . $extention;

                    $source_path = $_FILES['image']['tmp_name'];
                    $destination_path = "../images/category/" . $image_name;


                    $upload = move_uploaded_file($source_path, $destination_path);

                    //check whether the image is uploaded or not
                    //And if the image is not uploaded then we will stop the process
                    //and redirect with error message
                    if ($upload == false) {

                        //Set message
                        $_SESSION['upload'] = "<div class='alert-message error'>Failed to Upload Image</div>";
                        header('location:' . ROOT_URL . 'admin/manage-category.php');
                        die();
                    }

                    //B. Remove the current image if available
                    if ($current_image != "") {
                        $remove_path = "../images/category/".$current_image;
                        $remove = unlink($remove_path);

                        //check if the image is removed or not
                        if ($remove == false) {
                            $_SESSION['failed-removed'] = "<div class='alert-message error'>Failed to remove current Image</div>";
                            header('location:' . ROOT_URL . 'admin/manage-category.php');
                            die();
                        }
                    }
                } else {
                    $image_name = $current_image;
                }
            } else {
                $image_name = $current_image;
            }

            //3. Updating the DB
            $update_sql = "UPDATE tbl_category SET title='$title', image_name='$image_name', featured='$featured', active='$active' WHERE id='$id'";

            //execute the query
            $sql_update = mysqli_query($connection, $update_sql);

            if ($sql_update == true) {

                $_SESSION['update'] = "<div class='alert-message success'>Category updated successfully</div>";
                header('location:' . ROOT_URL . 'admin/manage-category.php');
                die();
            } else {
                $_SESSION['update'] = "<div class='alert-message error'>Fail to Update Category.</div>";
                header('location:' . ROOT_URL . 'admin/manage-category.php');
                die();
            }
        }

        ?>

    </div>
</div>

<?php include 'partials/footer.php'; ?>