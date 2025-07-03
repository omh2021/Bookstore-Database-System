<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $bookId = $_POST['book_id'];
    $price = $_POST['price'];
    $ageRating = $_POST['age_rating'];
    $genre = $_POST['genre'];
    $quantityAvailable = $_POST['quantity_available'];
    $title = $_POST['title'];

    // Database connection
    $conn = new mysqli('localhost', 'root', '', 'bookstore');
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Update statement instead of insert
    $sql = "UPDATE Book SET price = ?, age_rating = ?, genre = ?, quantity_available = ?, title = ? WHERE book_id = ?";
    $stmt = $conn->prepare($sql);
    // Note the order of variables and their types in bind_param has changed
    $stmt->bind_param("dssisi", $price, $ageRating, $genre, $quantityAvailable, $title, $bookId);
    $stmt->execute();

    // Check if the update was successful
    if ($stmt->affected_rows > 0) {
        echo "Book updated successfully.";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
