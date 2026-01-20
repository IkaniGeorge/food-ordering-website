<?php
include '../config/constant.php';

?>

<html>

<head>
    <title>Login-Food Order System</title>
    <link rel="stylesheet" href="../admin/css/admin.css">
</head>

<body>

    <div class="main-content">
        <div class="wrapper">
            <form class="form-container" method="POST">
                <h1 class="text-centre">Login</h1>
                <?php if (isset($_SESSION['login'])) : ?>
                    <div class="">
                        <p>
                            <?=
                            $_SESSION['login'];
                            unset($_SESSION['login']);
                            ?>
                        </p>
                    </div>
                    <br /><br />
                <?php endif ?>

                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" name="username" placeholder="username">
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" placeholder="password">
                </div>

                <div class="form-group">
                    <button type="submit" name="submit" class="submit-btn">Login</button>
                </div>
            </form>

        </div>
    </div>

</body>

</html>

<?php
if (isset($_POST['submit'])) {

    $username = $_POST['username'];
    $password = md5($_POST['password']);

    //SQL to check whether the user with the username and password exists or not
    $sql = "SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";
    //Execute the Query
    $check_sql = mysqli_query($connection, $sql);
    //Count rows to check whether the user exist or not
    $count = mysqli_num_rows($check_sql);
    if ($count == 1) {
        $_SESSION['login'] = "<div class='alert-message success'>Login Succesful</div>";
        header('location:' . ROOT_URL . 'admin/index.php');
        die();
    } else {
        $_SESSION['login'] = "<div class='alert-message error'>Login Failed. Username or Password didnt match</div>";
        header('location:' . ROOT_URL . 'admin/login.php');
        die();
    }
}

?>