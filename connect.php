<?php

$servername = "localhost"; 
$username = "root"; 
$password = "";
$dbname = "webfirst_project";


$con = new mysqli($servername, $username, $password, $dbname);


if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}


$sql = "SELECT title, description, image_url, button_text FROM menu_items";
$result = $con->query($sql);

?>