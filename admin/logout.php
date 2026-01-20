<?php
include '../config/constant.php';

session_destroy();
header('location:'. ROOT_URL . 'admin/login.php');
die();