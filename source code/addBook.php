<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $bookId = $_POST['book_id'];
    $price = $_POST['price'];
    $ageRating = $_POST['age_rating'];
    $genre = $_POST['genre'];
    $quantityAvailable = $_POST['quantity_available'];
    $title = $_POST['title'];

    if ($bookId === false || $price === false || $ageRating === false || $quantityAvailable === false) {
        die('Invalid input');
    }

    // Database connection
    $conn = new mysqli('localhost', 'root', '', 'bookstore');
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "INSERT INTO Book (book_id, price, age_rating, genre, quantity_available, title) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("idssis", $bookId, $price, $ageRating, $genre, $quantityAvailable, $title);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo "New book added successfully.";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
