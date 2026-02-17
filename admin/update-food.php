<?php include 'partials/menu.php'; ?>

<?php
//Check if ID is set ot not
if (isset($_GET['id'])) {

    $id = $_GET['id'];
    //create SQL QUERY to get selected food
    $sql = "SELECT * FROM tbl_food WHERE id='$id'";

    //Execute the query
    $update_sql = mysqli_query($connection, $sql);

    //$count = mysqli_num_rows($update_sql);


    //getting all the datas
    $row2 = mysqli_fetch_assoc($update_sql);

    //get the individual values of selected food.
    $title = $row2['title'];
    $description = $row2['description'];
    $price = $row2['price'];
    $current_image = $row2['image_name'];
    $current_category = $row2['category_id'];
    $featured = $row2['featured'];
    $active = $row2['active'];
} else {
    header('location:' . ROOT_URL . 'admin/manage-food.php');
}

?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Food</h1>
        <br /><br />

        <form action="" method="POST" enctype="multipart/form-data">

            <div class="form-groupp">
                <label for="">Title</label>
                <input type="text" value="<?= $title ?>" name="title" placeholder="Name of the food">
            </div>


            <div class="form-groupp">
                <label for="">Description</label>
                <textarea name="description" cols="30" rows="5" placeholder="Description of the food"><?= $description ?></textarea>
            </div>


            <div class="form-groupp">
                <label for="">Price</label>
                <input type="number" name="price" value="<?= $price ?>">
            </div>


            <div class="form-groupp">
                <label for="">Current Image</label>
                <p>
                    <?php
                    if ($current_image == "") {
                        //Image not available
                        echo "<div class='alert-message error'>Image Not Available</div>";
                    } else {
                    ?>
                        <img src="<?= ROOT_URL ?>images/food/<?= $current_image ?>" width="50px">
                    <?php
                    }

                    ?>

                </p>
            </div>

            <div class="form-groupp">
                <label for="">Select New Image</label>
                <input type="file" name="image">
            </div>

            <div class="form-groupp">
                <label for="">Category</label>
                <select name="category">
                    <?php
                    //1. Query to get active categories
                    $category = "SELECT * FROM tbl_category WHERE active ='Yes'";

                    //2.Execute Query
                    $res1 = mysqli_query($connection, $category);

                    //3. Count the rows
                    $count1 = mysqli_num_rows($res1);

                    //4. Check whether category is available or not
                    if ($count1 > 0) {
                        //5. Category available  
                        while ($row = mysqli_fetch_assoc($res1)) {

                            $category_title = $row['title'];
                            $category_id = $row['id'];

                            // echo "<option value='$category_id'>$category_title</option>";
                    ?>
                            <option
                                <?php
                                if ($current_category == $category_id) {
                                    echo "selected";
                                } ?> value="<?= $category_id ?>">
                                <?= $category_title ?>
                            </option>
                    <?php
                        }
                    } else {
                        //Category not available
                        echo "<option value='0'>Category Not Available</option>";
                    }
                    ?>
                </select>
            </div>


            <div class="form-groupp">
                <label for="">Featured</label>
                <div class="radio-group">
                    <label><input <?php if ($featured == "Yes") {
                                        echo "Checked";
                                    } ?> type="radio" name="featured" value="Yes">Yes</label>
                    <label><input <?php if ($featured == "No") {
                                        echo "Checked";
                                    } ?> type="radio" name="featured" value="No">No</label>
                </div>
            </div>


            <div class="form-groupp">
                <label for="">Active</label>
                <div class="radio-group">
                    <label><input <?php if ($active == "Yes") {
                                        echo "Checked";
                                    } ?> type="radio" name="active" value="Yes">Yes</label>
                    <label><input <?php if ($active == "No") {
                                        echo "Checked";
                                    } ?> type="radio" name="active" value="No">No</label>
                </div>
            </div>

            <div class="form-groupp">
                <input type="hidden" name="id" value="<?= $id ?>">
                <input type="hidden" name="current_image" value="<?= $current_image ?>">
                <input type="submit" name="submit" value="Update food" class="btn-secondary">
            </div>
        </form>

        <?php

        if (isset($_POST['submit'])) {

            //Get all the values from our form
            $id = $_POST['id'];
            $title = $_POST['title'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $current_image = $_POST['current_image'];
            $category = $_POST['category'];
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
                    $image_name = "Food_name" . rand(000, 9999) . '.' . $extention;

                    //Get the source oath and destination path
                    $source_path = $_FILES['image']['tmp_name'];
                    $destination_path = "../images/food/" . $image_name;


                    $upload = move_uploaded_file($source_path, $destination_path);

                    //check whether the image is uploaded or not
                    //And if the image is not uploaded then we will stop the process
                    //and redirect with error message
                    if ($upload == false) {

                        //Set message
                        $_SESSION['upload'] = "<div class='alert-message error'>Failed to Upload Image</div>";
                        header('location:' . ROOT_URL . 'admin/manage-food.php');
                        die();
                    }

                    //B. Remove the current image if available
                    if ($current_image != "") {
                        $remove_path = "../images/food/" . $current_image;
                        $remove = unlink($remove_path);

                        //check if the image is removed or not
                        if ($remove == false) {
                            $_SESSION['failed-removed'] = "<div class='alert-message error'>Failed to remove current Image</div>";
                            header('location:' . ROOT_URL . 'admin/manage-food.php');
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
            $update_sql1 = "UPDATE tbl_food SET title='$title', 
            description='$description', price='$price', 
            image_name='$image_name', category_id='$category',
            featured='$featured', active='$active' WHERE id='$id'";

            //execute the query
            $sql_update = mysqli_query($connection, $update_sql1);

            if ($sql_update == true) {

                $_SESSION['update'] = "<div class='alert-message success'>Food updated successfully</div>";
                header('location:' . ROOT_URL . 'admin/manage-food.php');
                die();
            } else {
                $_SESSION['update'] = "<div class='alert-message error'>Fail to Update Category.</div>";
                header('location:' . ROOT_URL . 'admin/manage-food.php');
                die();
            }
        }

        ?>

    </div>
</div>

<?php include 'partials/footer.php'; ?>