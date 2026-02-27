<?php include 'partial-front/menu.php'; ?>


<!-- fOOD sEARCH Section Ends Here -->
<!-- CAtegories Section Starts Here -->
<section class="categories">
    <div class="container">
        <h2 class="text-center">Explore Foods</h2>

        <?php
        //Display all the categories that are active
        //SQL Query
        $sql = "SELECT * FROM tbl_category WHERE active='Yes'";
        //Execute the query
        $res = mysqli_query($connection, $sql);
        //Count rows
        $count = mysqli_num_rows($res);

        if ($count > 0) {

            while ($row = mysqli_fetch_assoc($res)) {
                $id = $row['id'];
                $title = $row['title'];
                $image_name = $row['image_name'];
        ?>

                <a href="category-foods.php">
                    <div class="box-3 float-container">
                        <?php
                        //check if image name is available
                        if ($image_name == "") {
                            //image is not available
                            echo "<div class'alert-message error'>Image not available</div>";
                        } else {
                            //image is available
                        ?>
                            <img src="<?= ROOT_URL ?>images/category/<?= $image_name ?> " alt="Pizza" class="img-responsive img-curve">;
                        <?php

                        }

                        ?>



                        <h3 class="float-text text-white"><?= $title ?></h3>
                    </div>
                </a>


        <?php
            }
        } else {
            echo "<div class='alert-message error'>Category Not Found</div>";
        }


        ?>



        <div class="clearfix"></div>
    </div>
</section>
<!-- Categories Section Ends Here -->

<?php include 'partial-front/footer.php'; ?>