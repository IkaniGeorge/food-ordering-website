<?php include 'partials/menu.php'; ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Food</h1>
        <br /><br />
        <!-------Add Category form---->
        <form action="" method="POST" enctype="multipart/form-data">

            <div class="form-groupp">
                <label for="">Title</label>
                <input type="text" name="title" placeholder="Category Tiltle">
            </div>


            <div class="form-groupp">
                <label for="">Description</label>
                <textarea name="description" cols="30" rows="5" placeholder="Description of food"></textarea>
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
                    //1. Create SQL to get all active categories from DB
                    //Query to get form from Add Category
                    $insert_sql = "SELECT * FROM tbl_category WHERE active='Yes'";

                    //executing the Query
                    $insert_result = mysqli_query($connection, $insert_sql);

                    //Count rows to check if we have categories or not
                    $count = mysqli_num_rows($insert_result);

                    if ($count > 0) {

                        // we have categories.
                        while ($row = mysqli_fetch_assoc($insert_result)) {
                            // get the data of food categories and display
                            $id = $row['id'];
                            $title = $row['title'];

                    ?>
                            <option value="<?= $id ?>"><?= $title ?></option>

                        <?php
                            // $description = $row['description'];
                            // $price = $row['price'];
                            // $image_name = $row['image_name'];
                            // $featured = $row['featured'];
                            // $active = $row['active'];
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

    </div>
</div>

<?php include 'partials/footer.php'; ?>