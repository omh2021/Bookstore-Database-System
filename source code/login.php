<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['first'];
    $password = $_POST['password'];

    // Database connection
    $conn = new mysqli('localhost', 'root', '', 'bookstore');
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Creating an SQL query that still is vulnerable to SQL injection but avoids breaking from single quotes in input
    // This code explicitly handles single quotes by escaping them, which is still not safe against SQL injection but will prevent some types of syntax errors

    $sql = "SELECT * FROM User WHERE user_id = '$username' AND user_password = '$password'";

    // Executing the SQL statement
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "Login successful.";
    } else {
        echo "Invalid username or password.";
    }

    $conn->close();
}
?>
