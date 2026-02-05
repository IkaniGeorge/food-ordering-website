<?php include 'partials/menu.php'; ?>


<div class="main-content">
    <div class="wrapper">
        <h1>Add Category</h1>
        <br />

        <?php

        if (isset($_SESSION['added']))

            echo $_SESSION['added'];
        unset($_SESSION['added']);

        if (isset($_SESSION['upload']))

            echo $_SESSION['upload'];
        unset($_SESSION['upload']);

        ?>
        <br /><br />

        <!-------Add Category form---->
        <form action="" method="POST" enctype="multipart/form-data">

            <div class="form-groupp">
                <label for="">Title</label>
                <input type="text" name="title" placeholder="Category Tiltle">
            </div>


            <div class="form-groupp">
                <label for="">Select Image</label>
                <input type="file" name="image">
            </div>


            <div class="form-groupp">
                <label for="">Featured</label>
                <div class="radio-group">
                    <label><input type="radio" name="featured" value="Yes">Yes</label>
                    <label><input type="radio" name="featured" value="No">No</label>
                </div>
            </div>


            <div class="form-groupp">
                <label for="">Active</label>
                <div class="radio-group">
                    <label><input type="radio" name="active" value="Yes">Yes</label>
                    <label><input type="radio" name="active" value="No">No</label>
                </div>
            </div>

            <div class="form-groupp">
                <input type="submit" name="submit" value="Add category" class="btn-secondary">
            </div>


        </form>
        
        <?php
        //check if the submit button is active
        if (isset($_POST['submit'])) {

            //getting the value from the category form
            $title = $_POST['title'];

            //for radio input, we need to check if the button is selected or not
            if (isset($_POST['featured'])) {
                //getting the value from the form
                $feature = $_POST['featured'];
            } else {
                //set the default button to no
                $feature = "No";
            }

            if (isset($_POST['active'])) {
                //getting the value from the form
                $active = $_POST['active'];
            } else {
                $active = "No";
            }

            if (isset($_FILES['image']['name'])) {
                //Upload the image
                //To upload image we need image name, source path and destination path
                $image_name = $_FILES['image']['name'];

                //Upload the image only if image is selected
                if ($image_name != "") {



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

                        //Finally upload the image
                        $_SESSION['upload'] = "<div class='alert-message error'>Failed to Upload Image</div>";
                        header('location:' . ROOT_URL . 'admin/add-category.php');
                        die();
                    }
                }
            } else {
                //dont upload image and set the image_name value as blank
                $image_name = "";
            }


            //create SQL Query to insert Category into DB
            $insert_cat = "INSERT INTO tbl_category SET title='$title', image_name='$image_name', featured='$feature', active='$active'";

            //execute the query
            $sql = mysqli_query($connection, $insert_cat);

            //check if the query executed or not and data added or not
            if ($sql == TRUE) {
                //query executed and Category added
                $_SESSION['added'] = "<div class='alert-message success'>Category added successfully</div>";
                header('location:' . ROOT_URL . 'admin/manage-category.php');
                die();
            } else {
                //fail to add category
                $_SESSION['added'] = "<div class='alert-message error'>Failed to Add Category</div>";
                header('location:' . ROOT_URL . 'admin/manage-category.php');
                die();
            }
        }
        ?>
    </div>
</div>


<?php include 'partials/footer.php'; ?>