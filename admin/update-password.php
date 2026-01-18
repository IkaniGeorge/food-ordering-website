<?php include 'partials/menu.php'; ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Change password</h1>
        <br /><br />

        <?php
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
        }
        ?>

        <form class="form-container" method="POST">

            <div class="form-group">
                <label for="CurrentPassword">Current Password</label>
                <input type="password" name="current_password" placeholder="Enter Current Password">
            </div>

            <div class="form-group">
                <label for="NewPassword">New Password</label>
                <input type="password" name="new_password" placeholder="Enter New Password">
            </div>

            <div class="form-group">
                <label for="ConfirmPassword">Confirm Password</label>
                <input type="password" name="confirm_password" placeholder="Confirm New Password">
            </div>

            <div class="form-group">
                <input type="hidden" name="id" value="<?= $id ?>">
                <button type="submit" name="submit" class="submit-btn">Change password</button>
            </div>
        </form>

    </div>
</div>

<?php
if (isset($_POST['submit'])) {

    //CHANGING PASSWORD

    //1.Get the data from form
    $id = $_POST['id'];
    $current_password = md5($_POST['current_password']);
    $new_password = md5($_POST['new_password']);
    $confirm_password = md5($_POST['confirm_password']);

    //2. check whether the user with current ID and current password exist or not
    $check_sql = "SELECT * FROM  tbl_admin WHERE id=$id AND password='$current_password'";
    // Execute the Query
    $check_quer = mysqli_query($connection, $check_sql);

    if ($check_quer == TRUE) {

        //check whether data is available or not
        $count = mysqli_num_rows($check_quer);

        if ($count == 1) {
            //user exist and password can be changed
            //echo 'user found';

            //check whether the new password and the confirm password matches or not
            if ($new_password == $confirm_password) {

                //update the password
                $check_sql2 = "UPDATE tbl_admin SET password='$new_password' WHERE id='$id'";
                $check_quer2 = mysqli_query($connection, $check_sql2);

                if($check_quer2==TRUE){
                    //display success message
                  $_SESSION['pwd-match'] = "<div class='alert-message success'>Password Change successfully.</div>";
                //redirect user back to manage admin page
                header('location:' . ROOT_URL . 'admin/manage-admin.php');
                die();

                }else{
                      $_SESSION['pwd-match'] = "<div class='alert-message error'>Fail to change Password.</div>";
                //redirect user back to manage admin page
                header('location:' . ROOT_URL . 'admin/manage-admin.php');
                die();
                }


            } else {
                $_SESSION['pwd-not-match'] = "<div class='alert-message error'>Password do not match.</div>";
                //redirect user back to manage admin page
                header('location:' . ROOT_URL . 'admin/manage-admin.php');
                die();
            }
        } else {
            //user does not exist 
            $_SESSION['user-not-found'] = "<div class='alert-message error'>User not found.</div>";
            header('location:' . ROOT_URL . 'admin/manage-admin.php');
            die();
        }
    }
}

?>
 




<?php include 'partials/footer.php'; ?>