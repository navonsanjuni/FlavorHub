<?php
// Include database connection
include '../connect.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);

    // Check if the username already exists
    $checkUserQuery = "SELECT * FROM customer WHERE name = '$name'";
    $result = mysqli_query($con, $checkUserQuery);

    if (mysqli_num_rows($result) > 0) {
        // Username already exists
        echo "Username already exists!";
    } else {
        // Hash the password for security
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Insert user data into the database
        $sql = "INSERT INTO customer (name, email, password) VALUES ('$name', '$email', '$hashedPassword')";

        if (mysqli_query($con, $sql)) {
            echo "Registration successful!";
            header("Location:login.php");
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($con);
        }
    }

    // Close the database connection
    mysqli_close($con);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Registration</title>
</head>
<body>
    <h2>Register</h2>
    <form action="register.php" method="post">
        <label for="name">Name:</label><br>
        <input type="text" id="name" name="name" required><br><br>
        
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" required><br><br>
        
        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password" required><br><br>
        
        <input type="submit" value="Register">
    </form>
</body>
</html>
