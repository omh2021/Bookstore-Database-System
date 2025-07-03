<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_POST['user_id'];
    $oldpwd = $_POST['old_password'];
    $new_password = $_POST['new_password'];

    // Database connection
    $conn = new mysqli('localhost', 'root', '', 'bookstore');
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Using Prepared Statements to update password
    $stmt = $conn->prepare("UPDATE User SET user_password = ? WHERE user_id = ? AND user_password = ?");
    $stmt->bind_param("sss", $new_password, $user_id, $oldpwd);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo "Password changed successfully.";
    } else {
        echo "Failed to change password.";
    }

    $stmt->close();
    $conn->close();
}
?>
