<?php
header('Content-Type: application/json');

// Verbindung zur Datenbank herstellen
$servername = "database-5016057859.webspace-host.com";
$username = "dbu1018836";
$password = "C4r$10K1ng!";
$dbname = "dbs13081185";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Verbindung zur Datenbank fehlgeschlagen: " . $conn->connect_error);
}

// Zufällige ASCII-Art aus der Tabelle uploads holen
$sql = "SELECT ascii_art FROM uploads ORDER BY RAND() LIMIT 1";
$result = $conn->query($sql);

$response = array();

if ($result->num_rows > 0) {
    // Daten aus dem Resultat holen
    $row = $result->fetch_assoc();
    // Ersetze Leerzeichen durch nicht umbrechbare Leerzeichen und Zeilenumbrüche durch <br>
    $ascii_art = nl2br(str_replace(' ', '&nbsp;', $row['ascii_art']));
    $response['ascii_art'] = $ascii_art;
} else {
    $response['ascii_art'] = null;
}

echo json_encode($response);

$conn->close();
?>
