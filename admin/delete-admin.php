<?php
include '../config/constant.php';

//get the ID of the admin to be deleted
$get_id= $_GET['id'];

//create SQL query to delete admin
$delete = "DELETE FROM tbl_admin WHERE id=$get_id";

//redirect to manage-admin page 
$get_result = mysqli_query($connection, $delete);

//check if the querry executed successfully
if($get_result==TRUE){

    //create session variable to display the message
    $_SESSION['delete'] = "<div class='alert-message success'>Admin deleted successfully.</div>";

    //redirect to manage admin page
    header('location:'  . ROOT_URL . 'admin/manage-admin.php');
}else{

    $_SESSION['delete'] = "<div class='alert-message error'>fail to delete admin, try again.</div>";
     header('location:'  . ROOT_URL . 'admin/manage-admin.php');
     //go back to manage session and add the display message
}

?>