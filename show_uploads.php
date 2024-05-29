<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ascii_art_db";

// Verbindung zur Datenbank herstellen
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Verbindung fehlgeschlagen: " . $conn->connect_error);
}

$sql = "SELECT * FROM uploads ORDER BY upload_time DESC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<div style='border: 1px solid #ddd; padding: 10px; margin-bottom: 10px;'>";
        echo "<p><strong>Hochgeladen am:</strong> " . $row['upload_time'] . "</p>";
        echo "<p><strong>Zeichenanzahl:</strong> " . $row['num_chars'] . "</p>";
        echo "<div style='font-family: monospace; white-space: pre;'>" . $row['ascii_art'] . "</div>";
        echo "</div>";
    }
} else {
    echo "Keine Uploads vorhanden.";
}

$conn->close();
?>
