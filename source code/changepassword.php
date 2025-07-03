<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_POST['user_id'];
    $oldpwd = $_POST['old_password'];
    $new_password = $_POST['new_password'];

    // Database connection
    $conn = new mysqli('localhost', 'root', '', 'bookstore');

    // Directly including user input in SQL query (vulnerable to SQL injection)
    $sql = "UPDATE User SET user_password = '$new_password' WHERE user_id = '$user_id' AND user_password = '$oldpwd'";

    $result = $conn->query($sql);
    if ($result) {
        echo "Password changed successfully";
    }
    else {
        echo "Failed to change password";
    }

    $conn->close();
}
?>
