<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $genre = $_POST['genre'];

    // Database connection
    $conn = new mysqli('localhost', 'root', '', 'bookstore');
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare SQL statement
    $sql = "SELECT title, genre, age_rating, price, quantity_available 
            FROM Book
            WHERE genre LIKE ?";

    $stmt = $conn->prepare($sql);

    // Using '%' wildcards for LIKE queries
    $genre = "%$genre%";

    $stmt->bind_param("s", $genre); // Removed unnecessary 'i' from bind_param

    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Output data of each row
        while ($row = $result->fetch_assoc()) {
            echo "Title: " . $row["title"] . " - Genre: " . $row["genre"] . " - Age Rating: " . $row["age_rating"] . " - Price: " . $row["price"] . " - Quantity Available: " . $row["quantity_available"] . "<br>";
        }
    } else {
        echo "0 results";
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Invalid request";
}
?>