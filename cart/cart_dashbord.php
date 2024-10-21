<?php
include '../connect.php';
session_start();

$user_id = $_SESSION['user_id']; // Assuming user_id is passed as a query parameter or obtained from session

// Query to get items in the user's cart
$sql = "
    SELECT items.item_id AS item_id, items.name, items.description, items.price, items.image_link 
    FROM cart_items 
    JOIN cart ON cart_items.cart_id = cart.id 
    JOIN items ON cart_items.item_id = items.item_id 
    WHERE cart.user_id = '$user_id'";

$result = mysqli_query($con, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            padding: 20px;
            gap: 20px;
        }

        .cart-item {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            width: 250px;
            text-align: center;
            transition: transform 0.2s ease-in-out;
        }

        .cart-item:hover {
            transform: scale(1.05);
        }

        .cart-item .image img {
            width: 100%;
            height: 150px;
            object-fit: cover;
            border-bottom: 1px solid #ddd;
        }

        .cart-item .name {
            font-size: 1.2em;
            font-weight: bold;
            color: #333;
            margin: 10px 0;
        }

        .cart-item .desc {
            font-size: 0.9em;
            color: #777;
            padding: 0 10px;
            height: 60px;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .cart-item .price {
            font-size: 1.1em;
            color: #28a745;
            font-weight: bold;
            margin: 10px 0;
        }
    </style>
</head>
<body>
    <?php if (mysqli_num_rows($result) > 0): ?>
        <?php while ($row = mysqli_fetch_assoc($result)): ?>
            <div class="cart-item">
                <div class="image"><img src="<?php echo $row['image_link']; ?>" alt=""></div>
                <div class="name"><?php echo $row['name']; ?></div>
                <div class="desc"><?php echo $row['description']; ?></div>
                <div class="price">$<?php echo $row['price']; ?></div>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <p>No items in your cart.</p>
    <?php endif; ?>

    <?php
    // Close the database connection
    mysqli_close($con);
    ?>
</body>
</html>
