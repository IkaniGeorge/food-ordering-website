<?php
include '../config/constant.php';

//Get the ID of the Admin to be deleted
if (isset($_GET['id']) && isset($_GET['image_name'])) {

    $id = $_GET['id'];
    $image_name = $_GET['image_name'];

    //Remove image from file if available
    if ($image_name != "") {
        //image is available
        $path = "../images/food/".$image_name;
        $remove = unlink($path);

        //if fail to remove the image
        if ($remove == false) {
            //Create session variable to display message
            $_SESSION['remove'] = "<div class='alert-message error'>Fail to remove image.</div>";
            //redirect to manage admin page
            header('location:'  . ROOT_URL . 'admin/manage-food.php');
            die();
        }
    }

    //SQL to delete food from data base
    $delete = "DELETE FROM tbl_food WHERE id=$id";
    //execute the query
    $sql = mysqli_query($connection, $delete);
    //check if the data is deleted
    if ($sql == true) {
        $_SESSION['delete'] = "<div class='alert-message success'>Food Deleted Successfully.</div>";
        //redirect to manage admin page
        header('location:'  . ROOT_URL . 'admin/manage-food.php');
        die();
    } else {
        $_SESSION['delete'] = "<div class='alert-message error'>Fail to Delete Food.</div>";
        //redirect to manage admin page
        header('location:'  . ROOT_URL . 'admin/manage-food.php');
        die();
    }
} else {
    //Create session variable to display message
    $_SESSION['unathaurize'] = "<div class='alert-message success'>Unauthorized Access.</div>";
    //redirect to manage admin page
    header('location:'  . ROOT_URL . 'admin/manage-food.php');
}
