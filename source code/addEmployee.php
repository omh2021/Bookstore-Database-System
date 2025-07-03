<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userId = $_POST['user_id'];
    $password = $_POST['user_password'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $salary = $_POST['salary'];

    // Database connection
    $conn = new mysqli('localhost', 'root', '', 'bookstore');
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // First INSERT INTO User
    $sqlUser = "INSERT INTO User (user_id, user_password, name, email) VALUES (?, ?, ?, ?)";
    $stmtUser = $conn->prepare($sqlUser);
    $stmtUser->bind_param("isss", $userId, $password, $name, $email);
    $stmtUser->execute();
    if ($stmtUser->affected_rows > 0) {
        echo "New user added successfully. ";
    } else {
        echo "Error: " . $stmtUser->error;
    }
    $stmtUser->close();

    // Then INSERT INTO Employee
    $sqlEmployee = "INSERT INTO Employee (user_id, salary) VALUES (?, ?)";
    $stmtEmployee = $conn->prepare($sqlEmployee);
    $stmtEmployee->bind_param("ii", $userId, $salary);
    $stmtEmployee->execute();
    if ($stmtEmployee->affected_rows > 0) {
        echo "Employee record created successfully.";
    } else {
        echo "Error: " . $stmtEmployee->error;
    }
    $stmtEmployee->close();

    $conn->close();
}
?>
