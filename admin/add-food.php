<?php include 'partials/menu.php'; ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Food</h1>
        <br /><br />
        <?php
        if (isset($_SESSION['upload']))
            echo  $_SESSION['upload'];
             unset($_SESSION['upload']);

        ?>
        <form action="" method="POST" enctype="multipart/form-data">

            <div class="form-groupp">
                <label for="">Title</label>
                <input type="text" name="title" placeholder="Name of the food">
            </div>


            <div class="form-groupp">
                <label for="">Description</label>
                <textarea name="description" cols="30" rows="5" placeholder="Description of the food"></textarea>
            </div>


            <div class="form-groupp">
                <label for="">Price</label>
                <input type="number" name="price">
            </div>


            <div class="form-groupp">
                <label for="">Select Image</label>
                <input type="file" name="image">
            </div>

            <div class="form-groupp">
                <label for="">Category</label>
                <select name="category">

                    <?php
                    //create php code to display categories from DB
                    //1.Create SQL to get all active categories from DB
                    //Query to get form from Add Category
                    $insert_sql = "SELECT * FROM tbl_category WHERE active='Yes'";

                    //executing the Query
                    $insert_result = mysqli_query($connection, $insert_sql);

                    //Count rows to check if we have categories or not
                    $count = mysqli_num_rows($insert_result);

                    if ($count > 0) {

                        // we have categories.
                        while ($rows = mysqli_fetch_assoc($insert_result)) {
                            // get the data of food categories and display
                            $id = $rows['id'];
                            $title = $rows['title'];

                        ?>
                            <option value="<?= $id ?>"><?= $title ?></option>

                        <?php

                        }
                    } else {

                        //When we dont have category
                        ?>
                        <option value="0">No Category Found</option>

                    <?php
                    }

                    ?>
                </select>
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
                <input type="submit" name="submit" value="Add food" class="btn-secondary">
            </div>


        </form>
        <!-------- to insert form into Data Base. ------->
        <?php
        if (isset($_POST['submit'])) {

            //1. Get the data from form
            $title = $_POST['title'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $category = $_POST['category'];

            // check if the radio buttons for featured and active are checked or not
            if (isset($_POST['featured'])) {
                $featured = $_POST['featured'];
            } else {
                // if is not, set the value to be NO
                $featured = "No";
            }

            if (isset($_POST['active'])) {
                $active = $_POST['active'];
            } else {
                // if is not, set the value to be NO
                $active = "No";
            }

            //2. Upload the image if selected
            //Check whether the selected image is clicked or not and upload the image only if the image is selected
            if (isset($_FILES['image']['name'])) {

                //Get the details of the selected image
                $image_name = $_FILES['image']['name'];

                //Check whether the image is selected or not and upload image only if selected
                if ($image_name != "") {

                    //A. Auto renaming image to avoid naming conflict
                    //Getting image extension like jpg, jpeg, png, heic
                    $extention = end(explode('.', $image_name));

                    // Create new name for image
                    $image_name = "Food_Name" . rand(0000, 9999) . '.' . $extention;

                    // Source path is the current location of the image
                    $source_path = $_FILES['image']['tmp_name'];

                    // Destination path for the image to be uploaded.
                    $destination_path = "../images/food/".$image_name;

                    //Finally upload the food image
                    $upload = move_uploaded_file($source_path, $destination_path);

                    //check whether image is uploaded or not
                    if ($upload == false) {

                        $_SESSION['upload'] = "<div class='alert-message error'>Failed to Upload Image</div>";
                        header('location:' . ROOT_URL . 'admin/add-food.php');
                        die();
                    }
                }
            } else {
                $image_name = ""; //Setting default value as blank
            }

            //3. Insert into Data Base
            //Create SQL query to save or add food
            $sql = "INSERT INTO tbl_food SET title='$title', description='$description',
                     price='$price', image_name='$image_name', category_id='$category',
                     featured='$featured', active='$active'";

            //Execute query
            $insert = mysqli_query($connection, $sql);
            //check whether the data is inserted or not

                 //check if the query executed or not and data added or not
            if ($insert == TRUE) {
                
                $_SESSION['added'] = "<div class='alert-message success'>Food added successfully</div>";
                header('location:' . ROOT_URL . 'admin/manage-food.php');
                die();
            } else {
                //fail to add category
                $_SESSION['added'] = "<div class='alert-message error'>Failed to Add Food</div>";
                header('location:' . ROOT_URL . 'admin/manage-food.php');
                die();
            }

            //4. Redirect with message to home or any page


        }


        ?>

    </div>
</div>

<?php include 'partials/footer.php'; ?>