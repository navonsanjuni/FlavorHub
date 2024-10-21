<?php
// Include database connection
include '../connect.php';

// Fetch menus from the database for the dropdown
$menuQuery = "SELECT id, title FROM menu_items";
$menuResult = mysqli_query($con, $menuQuery);



// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $image_link = $_POST['image_link'];
    $availability = (int) $_POST['availability'];
    $menu = (int) $_POST['menu'];

    // Insert item into the database
    $sql = "INSERT INTO items (name, description, price, image_link, availability, menu) 
            VALUES ('$name', '$description', $price, '$image_link', $availability, $menu)";

    if (mysqli_query($con, $sql)) {
        echo "Item added successfully!";
        header("Location: add_items.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($con);
    }

    // Close the database connection
    mysqli_close($con);
}


?>

<!DOCTYPE html>
<html>
<head>
    <title>Add New Item</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
        }
        .form-container {
            max-width: 600px;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin: auto;
        }
        input, textarea, select {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            background-color: #28a745;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Add New Item</h2>
        <form action="add_items.php" method="post">
            <label for="name">Item Name:</label>
            <input type="text" id="name" name="name" required>

            <label for="description">Description:</label>
            <textarea id="description" name="description" rows="4" required></textarea>

            <label for="price">Price:</label>
            <input type="number" id="price" name="price" required>

            <label for="image_link">Image Link:</label>
            <input type="url" id="image_link" name="image_link" required>

            <label for="availability">Availability:</label>
            <select id="availability" name="availability" required>
                <option value="1">Available</option>
                <option value="0">Not Available</option>
            </select>

            <label for="menu">Select Menu:</label>
            <select id="menu" name="menu" required>
                <?php
                // Loop to create dropdown options from menus
                if (mysqli_num_rows($menuResult) > 0) {
                    while ($menuRow = mysqli_fetch_assoc($menuResult)) {
                        echo "<option value='{$menuRow['id']}'>{$menuRow['title']}</option>";
                    }
                } else {
                    echo "<option value=''>No menus available</option>";
                }
                ?>
            </select>

            <button type="submit">Add Item</button>
        </form>
    </div>
</body>
</html>
