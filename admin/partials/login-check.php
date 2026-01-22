
<?php 
  //AUTHORIZATION - ACCESS CONTROL
  //CHECK IF THE USER IS LOGGED IN OR NOT
  if(!isset($_SESSION['user'])){   //if user is not set

    //user isnt logged in
    $_SESSION['no-login-message']= "<div class='alert-message error'>Please login to access Admin Panel</div>";
    header('location:' . ROOT_URL . 'admin/login.php');
    die(); 

  }
  


?>