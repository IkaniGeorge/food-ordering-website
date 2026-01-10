
<?php include 'partials/menu.php'?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Admin</h1>

        <br/><br/> 
        <?php 
        //Selecting the user to update

            //1. Get the ID of selected admin
        
            $id = $_GET['id'];

            //2. Create SQL details to get the details
            $update_user = "SELECT * FROM tbl_admin WHERE id= $id";
            
            //3. Execute querry 
            $update_user_result = mysqli_query($connection, $update_user);
            
            //4. Check if the querry is executed
            if($update_user_result==TRUE) {

                // check if the data is available or not
                $count = mysqli_num_rows($update_user_result);

                //check if we have admin data or not
                if($count==1){

                    //get details and update
                    //echo 'admin available';
                     $get_datails = mysqli_fetch_assoc($update_user_result);

                     $full_name = $get_datails['full_name'];
                     $username = $get_datails['username'];

                }else{
                    // Redirect to manage-admin page
                    header('location:' . ROOT_URL . 'admin/manage-admin.php');
                    die();
                }
            };

        ?>



        <form class="form-container" method="POST">

            <div class="form-group">
                <label for="full name">Full Name</label>
                <input type="text" name="full_name" value="<?= $full_name ?>">
            </div>

            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" name="username" value="<?= $username ?>">
            </div>
                
            <div class="form-group">
                <input type="hidden" name="id" value="<?= $id ?>">
            <button type="submit" name="submit" class="submit-btn">Update Admin</button>
            </div>
        </form>

    </div>
</div>

<?php 
//Updating the user

if(isset($_POST['submit'])){

    //Get all the values from form to update
    $id = $_POST['id'];
    $full_name = $_POST['full_name'];
    $username = $_POST['username'];

    //create SQL Query to update Admin
    $update = "UPDATE tbl_admin SET full_name= '$full_name',  username='$username' WHERE id='$id'";

    //Execute querry
    $update_result = mysqli_query($connection, $update);

    //check if the querry executes
    if($update_result==TRUE){

        //Query executed and Admin Updated
        $_SESSION['update'] = "<div class='alert-message success'>Admin Updated Successfully</div>";
        header('location:' . ROOT_URL . 'admin/manage-admin.php');
        die();

    }else{

         //Fail to Updated Admin
        $_SESSION['update'] = "<div class='alert-message error'>Failed to Updated Admin</div>";
        header('location:' . ROOT_URL . 'admin/manage-admin.php');
        die();
    }

}


?>


<?php include 'partials/footer.php' ?>