<?php
include '../connect.php';
session_start();

$user_id = $_SESSION['user_id']; // Assuming user_id is obtained from the form or session
$item_id = $_GET['item_id']; // Assuming item_id is obtained from the form

// Step 1: Check if the user already has a cart
$sql = "SELECT id FROM cart WHERE user_id = '$user_id'";
$result = mysqli_query($con, $sql);

if (mysqli_num_rows($result) > 0) {
    // User has an existing cart, get the cart_id
    $row = mysqli_fetch_assoc($result);
    $cart_id = $row['id'];
} else {
    // Step 2: No existing cart, insert a new cart row
    $insert_cart_sql = "INSERT INTO cart (user_id) VALUES ('$user_id')";
    if (mysqli_query($con, $insert_cart_sql)) {
        $cart_id = mysqli_insert_id($con); // Get the new cart_id
    } else {
        echo "Error: " . mysqli_error($con);
        exit;
    }
}

// Step 3: Check if the item is already in the cart
$check_item_sql = "SELECT * FROM cart_items WHERE cart_id = '$cart_id' AND item_id = '$item_id'";
$item_result = mysqli_query($con, $check_item_sql);

if (mysqli_num_rows($item_result) > 0) {
    echo "Item is already in the cart.";
} else {
    // Step 4: Add the item to the cart_items table
    $insert_item_sql = "INSERT INTO cart_items (cart_id, item_id) VALUES ('$cart_id', '$item_id')";
    if (mysqli_query($con, $insert_item_sql)) {
        header("location:cart_dashbord.php");
        echo "Item added to cart successfully!";
    } else {
        echo "Error: " . mysqli_error($con);
    }
}

// Close the database connection
mysqli_close($con);
?>
