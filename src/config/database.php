<?php
$host = "db";
$username = "ascii";
$password = "geheim";
$dbname = "ascii_art";

$db = new mysqli($host, $username, $password, $dbname);

if ($db->connect_error) {
    die("Verbindung zur Datenbank fehlgeschlagen: " . $db->connect_error);
}
?>