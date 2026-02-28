<?php include 'partial-front/menu.php'; ?>

<!-- fOOD sEARCH Section Starts Here -->
<section class="food-search text-center">
    <div class="container">

        <?php 
             $search = $_POST['search'] ;
        ?>
     <h2>Foods on Your Search <a href="#" class="text-red"><?= $search ?></a></h2>

    </div>
</section>
<!-- fOOD sEARCH Section Ends Here -->
<!-- fOOD MEnu Section Starts Here -->
<section class="food-menu">
    <div class="container">
        <h2 class="text-center">Food Menu</h2>

        <?php

        $sql = "SELECT * FROM tbl_food WHERE title LIKE '%$search%' OR description LIKE '%$search%'";
        $res = mysqli_query($connection, $sql);

        $count = mysqli_num_rows($res);

        if ($count > 0) {
            while ($row = mysqli_fetch_assoc($res)) {
                $id = $row['id'];
                $title = $row['title'];
                $price = $row['price'];
                $description = $row['description'];
                $image_name = $row['image_name'];

         ?>
            
         <div class="food-menu-box">
            <div class="food-menu-img">
                <?php 
                if($image_name ==""){
                    //image not available
                     echo "<div class'alert-message error'>image not available.</div>";

                }else{

                        //image available
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
            echo "<div class'alert-message error'>Food not found.</div>";
        }

        ?>
        <div class="clearfix"></div>

    </div>

</section>
<!-- fOOD Menu Section Ends Here -->

<?php include 'partial-front/footer.php'; ?>