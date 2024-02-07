<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// Połączenie z bazą danych
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "test";

$conn = new mysqli($servername, $username, $password, $dbname);

// Pobranie listy zadań z bazy danych
$result = $conn->query("SELECT * FROM tasks");

$rows = array();
while($r = $result->fetch_assoc()) {
    $rows[] = $r;
}

echo json_encode($rows); // Zwrócenie listy zadań w formacie JSON

$conn->close();
?>
