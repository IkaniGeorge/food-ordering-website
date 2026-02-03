<?php
include '../config/constant.php';

//get the ID of the admin to be deleted
if(isset($_GET['id']) AND isset($_GET['image_name'])){

$id = $_GET['id'];
$image_name = $_GET['image_name'];

//remove image from image file if available
if($image_name !=""){
    //image is available so remove it
    $path = "../images/category/".$image_name;
    $remove = unlink($path);
    
    //if fail to remove the image 
    if($remove==false){
     //create session variable to display the message
    $_SESSION['remove'] = "<div class='alert-message error'>Fail to remove image.</div>";
    //redirect to manage admin page
    header('location:'  . ROOT_URL . 'admin/manage-category.php');
    die();
    }
}
    //SQL data to delete data from data base
        $delete = "DELETE FROM tbl_category WHERE id=$id";
    //execute the query
        $sql = mysqli_query($connection, $delete);
    //check if the data is deleted
    if($sql==true){
          $_SESSION['delete'] = "<div class='alert-message success'>Delete successful.</div>";
    //redirect to manage admin page
    header('location:'  . ROOT_URL . 'admin/manage-category.php');
    die();
 
    }else{
          $_SESSION['delete'] = "<div class='alert-message error'>Fail to delete.</div>";
    //redirect to manage admin page
    header('location:'  . ROOT_URL . 'admin/manage-category.php');
    die();
    }


}else{
     //create session variable to display the message
    $_SESSION['delete'] = "<div class='alert-message success'>Admin deleted successfully.</div>";

    //redirect to manage admin page
    header('location:'  . ROOT_URL . 'admin/manage-category.php');
}

?>