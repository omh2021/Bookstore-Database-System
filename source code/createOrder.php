<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect input values
    $orderId = $_POST['order_id'];
    $customerId = $_POST['customer_id'];
    $bookId = $_POST['book_id'];
    $quantity = $_POST['quantity'];
    $orderDate = $_POST['order_date'];
    $orderDate = date('Y-m-d', strtotime($_POST['order_date']));

    // Database connection
    $conn = new mysqli('localhost', 'root', '', 'bookstore');
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // SQL query
    $sql = "INSERT INTO Orders (order_id, customer_id, book_id, quantity, order_date) VALUES (?, ?, ?, ?, ?)"; // Modify as per table
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iiiis", $orderId, $customerId, $bookId, $quantity, $orderDate);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo "Order created successfully.";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
