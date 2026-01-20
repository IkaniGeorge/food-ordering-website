<?php
include 'partials/menu.php';

?>

<!---- Main content section starts --->
<div class="main-content">
    <div class="wrapper">
        <h1>Dashboard</h1>

        <?php if (isset($_SESSION['login'])) : ?>
            <p>
                <?=
                $_SESSION['login'];
                unset($_SESSION['login']);
                ?>
            </p>

            <br /><br />
        <?php endif ?>

        <div class="col-4 text-center">
            <h1>1</h1> Categories
        </div>

        <div class="col-4 text-center">
            <h1>2</h1> Categories
        </div>

        <div class="col-4 text-center">
            <h1>3</h1> Categories
        </div>

        <div class="col-4 text-center">
            <h1>4</h1> Categories
        </div>


        <div class="clearfix"></div>
    </div>
</div>
<!---- Main content section ends --->

<?php include 'partials/footer.php'; ?>