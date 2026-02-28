<?php include 'partial-front/menu.php'; ?>

<!-- fOOD sEARCH Section Starts Here -->
<section class="food-search text-center">
    <div class="container">

        <form action="<?= ROOT_URL ?>food-search.php" method="POST">
            <input type="search" name="search" placeholder="Search for Food.." required>
            <input type="submit" name="submit" value="Search" class="btn btn-primary">
        </form>

    </div>
</section>
<!-- fOOD sEARCH Section Ends Here -->
<!-- CAtegories Section Starts Here -->
<section class="categories">
    <div class="container">
        <h2 class="text-center">Explore Foods</h2>

        <?php
        //Displaying food from DB on the webpage
        //create sql query to display categories from DB
        $sql = "SELECT * FROM tbl_category WHERE active='Yes' AND featured='Yes' LIMIT 3";

        //Execute query
        $res = mysqli_query($connection, $sql);

        //count rows to check whether the category is available
        $count = mysqli_num_rows($res);

        if ($count > 0) {
            //Categories available
            while ($row = mysqli_fetch_assoc($res)) {
                //get the values like id, title, image_name
                $id = $row['id'];
                $title = $row['title'];
                $image_name = $row['image_name'];
        ?>

            <!-------Displaying the food base on category selected---->
                <a href="<?= ROOT_URL ?>category-foods.php?category_id=<?= $id ?>">
                    <div class="box-3 float-container">
                        <?php
                        //check if image is available or not
                        if ($image_name == "") {
                            //display image
                            echo "<div class'alert-message error'>Image not available</div>";
                        } else {
                            //image is available
                        ?>
                            <img src="<?= ROOT_URL ?>images/category/<?= $image_name ?>" alt="Pizza" class="img-responsive img-curve">
                        <?php
                        }

                        ?>
                        <h3 class="float-text text-white"><?= $title ?></h3>
                    </div>
                </a>

        <?php

            }
        } else {

            echo "<div class'alert-message error'>Food not Added.</div>";
        }

        ?>

        <div class="clearfix"></div>
    </div>
</section>
<!-- Categories Section Ends Here -->

<!-- fOOD MEnu Section Starts Here -->
<section class="food-menu">
    <div class="container">
        <h2 class="text-center">Food Menu</h2>

        <?php
        $sql1 = "SELECT * FROM tbl_food WHERE active='Yes' AND featured='Yes' LIMIT 4";
        $res1 = mysqli_query($connection, $sql1);

        $count1 = mysqli_num_rows($res1);

        if ($count1 > 0) {

            while ($row = mysqli_fetch_assoc($res1)) {
                $id = $row['id'];
                $title = $row['title'];
                $description = $row['description'];
                $price = $row['price'];
                $image_name = $row['image_name'];

                 ?>

                <div class="food-menu-box">
                    <div class="food-menu-img">
                        <?php
                        if ($image_name == "") {

                            //image is not available
                            echo "<div class'alert-message error'>Image not available</div>";
                        } else {
                        ?>
                            <img src="<?= ROOT_URL?>images/food/<?= $image_name ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
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

                        <a href="order.html" class="btn btn-primary">Order Now</a>
                    </div>
                </div>

        <?php
            }
        } else {
            echo "<div class'alert-message error'>Food not Added.</div>";
        }




        ?>


        <div class="clearfix"></div>
    </div>

    <p class="text-center">
        <a href="#">See All Foods</a>
    </p>
</section>
<!-- fOOD Menu Section Ends Here -->


<?php include 'partial-front/footer.php'; ?>