<?php
session_start();

//for database
define('ROOT_URL', 'http://localhost/food%20oredering%20website/');
define('DB_HOST', 'localhost');
define('DB_USERNAME', 'ikani');
define('DB_PASSWORD', 'terrem_ifu1');
define('DB_NAME', 'order_food');

//connect to db
$connection = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
if(mysqli_errno($connection)){
    die(mysqli_error($connection));
}