<?php
// Include database connection
include '../connect.php';

// Fetch all operators from the database
$sql = "SELECT * FROM operator";
$result = mysqli_query($con, $sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <style>
        table {
            width: 80%;
            border-collapse: collapse;
            margin: 20px auto;
            font-family: Arial, sans-serif;
        }
        th, td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
        }
        button {
            padding: 5px 10px;
            cursor: pointer;
            border: none;
            border-radius: 5px;
            color: white;
        }
        .approve {
            background-color: green;
        }
        .block {
            background-color: red;
        }
    </style>
</head>
<body>
    <h2 style="text-align: center;">Admin Dashboard - Manage Operators</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
        <?php
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $status = $row['approved'] == 1 ? "Approved" : "Blocked";
                $buttonText = $row['approved'] == 1 ? "Block" : "Approve";
                $buttonClass = $row['approved'] == 1 ? "block" : "approve";
                echo "<tr>
                        <td>{$row['op_id']}</td>
                        <td>{$row['name']}</td>
                        <td>{$row['email']}</td>
                        <td>$status</td>
                        <td>
                            <form method='post' action='approved.php'>
                                <input type='hidden' name='op_id' value='{$row['op_id']}'>
                                <input type='hidden' name='current_status' value='{$row['approved']}'>
                                <button type='submit' class='$buttonClass'>$buttonText</button>
                            </form>
                        </td>
                    </tr>";
            }
        } else {
            echo "<tr><td colspan='5'>No operators found.</td></tr>";
        }

        // Close the database connection
        mysqli_close($con);
        ?>
    </table>
</body>
</html>
