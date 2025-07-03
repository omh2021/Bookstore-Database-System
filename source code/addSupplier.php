<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect input values
    $supplierId = $_POST['supplier_id'];
    $bookId = $_POST['book_id'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    // ... add more inputs as needed

    // Database connection
    $conn = new mysqli('localhost', 'root', '', 'bookstore');
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // SQL query
    $sql = "INSERT INTO Supplier (supplier_id, book_id, price, quantity) VALUES (?, ?, ?, ?)"; 
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iidi", $supplierId, $bookId, $price, $quantity); 
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo "Supplier added successfully.";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
