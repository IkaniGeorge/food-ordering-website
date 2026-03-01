<?php include 'partial-front/menu.php'; ?>

<?php

//DISPLAYING FOOD TITLE WHEN FOOD-CATEGORY IS CLICKED
if (isset($_GET['category_id'])) {

    //Category id is set and get the ID
    $category_id = $_GET['category_id'];
    //Get the category title based on CategoryID
    $sql = "SELECT title FROM tbl_category WHERE id=$category_id";
    //execute the query
    $res = mysqli_query($connection, $sql);
    //get the value from database
    $row = mysqli_fetch_assoc($res);

    $category_title = $row['title'];
} else {

    header('location:' . ROOT_URL);
}

?>

<!-- fOOD Search Section Starts Here -->
<section class="food-search text-center">
    <div class="container">

        <h2>Fodds on <a href="" class="text-white"><?= $category_title ?></a></h2>

    </div>

</section>

<!-- fOOD MEnu Section Starts Here -->
<section class="food-menu">
    <div class="container">
        <h2 class="text-center">Food Menu</h2>

        <?php
        //Create sql query to select food base on selected category
        $sql1 = "SELECT * FROM tbl_food WHERE category_id=$category_id";
        //execute the query
        $res1 = mysqli_query($connection, $sql1);

        //Count number of rows
        $count = mysqli_num_rows($res1);

        if ($count > 0) {
            while ($row = mysqli_fetch_assoc($res1)) {
                $title = $row['title'];
                $description = $row['description'];
                $price = $row['price'];
                $image_name = $row['image_name'];
        ?>

                <div class="food-menu-box">
                    <div class="food-menu-img">
                        <?php
                        if ($image_name == "") {

                            //food npt available
                            echo "<div class='alert-message error'>Image Not Available</div>";
                        } else {
                        ?>
                            <img src="<?= ROOT_URL ?>images/food/<?= $image_name ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                        <?php
                        }



                        ?>

                    </div>

                    <div class="food-menu-desc">
                        <h4><?= $title ?></h4>
                        <p class="food-price">$<?= $price ?></p>
                        <p class="food-detail">
                            <?= $description ?>
                        </p>
                        <br>

                        <a href="#" class="btn btn-primary">Order Now</a>
                    </div>
                </div>


        <?php
            }
        } else {
            //food not available
            echo "<div class='alert-message error'>Food Not Available</div>";
        }



        ?>

        <div class="clearfix"></div>
    </div>

</section>
<!-- fOOD Menu Section Ends Here -->

<?php include 'partial-front/footer.php'; ?>