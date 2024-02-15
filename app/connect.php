<?php
// Dane dostępowe do bazy danych
$servername = "localhost:3307";
$username = "root";
$password = ""; // Domyślne hasło w XAMPP jest puste
$dbname = "test";

// Połącz z bazą danych
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Sprawdź połączenie
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
