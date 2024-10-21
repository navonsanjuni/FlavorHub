<?php
// Include database connection
include '../connect.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $op_id = mysqli_real_escape_string($con, $_POST['op_id']);
    $current_status = (int) $_POST['current_status'];

    // Toggle the approval status
    $new_status = $current_status === 1 ? 0 : 1;

    // Update the operator's approval status
    $sql = "UPDATE operator SET approved = $new_status WHERE op_id = $op_id";

    if (mysqli_query($con, $sql)) {
        // Redirect back to the admin dashboard
        header("Location: admin_dashbord.php");
        exit();
    } else {
        echo "Error updating record: " . mysqli_error($con);
    }

    // Close the database connection
    mysqli_close($con);
}
?>
