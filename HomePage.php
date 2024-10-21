<?php
include "connect.php";

$sql = "SELECT * FROM menu_items";
$result = mysqli_query($con,$sql);
$item_list = array();

while($row=mysqli_fetch_assoc($result)){
    array_push($item_list,$row);
}


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="stylesheet" href="home.css">
     <title>Restaurant</title>


</head>
<body>
<header>
        <nav class="navbar">
            <div class="logo">
                <a href="index.html">
                    <img src="images/logo.png" alt="Website Logo">
                </a>
            </div>
            <ul class="nav-links">
                <li><a href="index.html">Home</a></li>
                <li><a href="about.html">About Us</a></li>
                <li><a href="menu.html">Food Menu</a></li>
                <li><a href="contact.html">Contact</a></li>
                <li><a href="cart/cart_dashbord.php">Cart</a></li>
                <li><a href="onlineOrder.php" >Order Online</a></li>
                <li><a href=""</li>
            </ul>
        </nav>
    </header>

   
    <section class="hero">
    <img src="https://tb-static.uber.com/prod/image-proc/processed_images/37ecc4a4723c9df6fb8b9d356d83cf61/fb86662148be855d931b37d6c1e5fcbe.jpeg" alt="food ordering image" class="animated-image">
        <h1>Welcome to FlavorHub</h1>
        <p>Your favorite meals delivered to your door</p>
    </section>

    <h2></h2>
    
    <div class="menu">
    <?php
    if (count($item_list)> 0) {

        foreach($item_list as $item){
            echo '<div class="menu-item">';
            echo '<img src="'   . $item["image_url"] . '" alt="' . $item["title"] . '">';
            echo '<h3>' . $item["title"] . '</h3>';
            echo '<p>' . $item["description"] . '</p><br>';
            echo '<a href="itemdesplay.php?menu_id='.$item['id'].'"><button class="btn-1">' . $item["button_text"] . '</button></a>';
            echo '</div>';
        }
        
       
    } else {
        echo "No menu items found.";
    }

    $con->close();
    ?>
</div>

<div class="section-container">
    <div class="image-container">
        <img src="https://cdn.britannica.com/02/239402-050-ACC075DB/plates-of-vegan-foods-ready-serve-restaurant-London.jpg" alt="Delicious Food" >
    </div>
    <div class="content-container">
        <h2>Why People Choose Us</h2>
        <ul>
            <li>Fresh and high-quality ingredients.</li>
            <li>Quick and reliable delivery.</li>
            <li>Variety of cuisines to choose from.</li>
            <li>Easy and convenient online ordering.</li>
            <li>Affordable prices and special deals.</li>
        </ul>
    </div>
</div>


</body>
</html>