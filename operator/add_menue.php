<?php
// Include database connection
include '../connect.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $title = mysqli_real_escape_string($con, $_POST['title']);
    $description = mysqli_real_escape_string($con, $_POST['description']);
    $image_url = mysqli_real_escape_string($con, $_POST['image_url']);

    // Insert item into the database
    $sql = "INSERT INTO menu_items (title, description, image_url) VALUES ('$title', '$description', '$image_url')";

    if (mysqli_query($con, $sql)) {
        echo "Item added successfully!";
        header("Location: op_dashbord.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($con);
    }

    // Close the database connection
    mysqli_close($con);
}
?>






<?php
// Include database connection
include '../connect.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Operator Dashboard - Add Items</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            padding: 20px;
            background-color: #f9f9f9;
        }
        .form-container {
            max-width: 500px;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin: auto;
        }
        input, textarea {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        textarea {
            resize: vertical;
        }
        button {
            background-color: #28a745;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
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
    <form action="add_menue.php" method="post">
        <label for="title">Title:</label><br>
        <input type="text" id="title" name="title" required><br>

        <label for="description">Description:</label><br>
        <textarea id="description" name="description" rows="4" required></textarea><br>

        <label for="image_url">Image URL:</label><br>
        <input type="url" id="image_url" name="image_url" required><br>

        <button type="submit">Add Item</button>
    </form>
</div>

</body>
</html>
