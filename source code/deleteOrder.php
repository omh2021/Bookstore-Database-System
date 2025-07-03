<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect order ID from the form input
    $orderId = $_POST['order_id'];

    // Database connection
    $conn = new mysqli('localhost', 'root', '', 'bookstore');
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // SQL query to delete the order
    $sql = "DELETE FROM Orders WHERE order_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $orderId);
    $stmt->execute();

    // Check if the delete was successfull
    if ($stmt->affected_rows > 0) {
        echo "Order deleted successfully.";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
