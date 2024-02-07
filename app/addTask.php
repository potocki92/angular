<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// Pobranie danych z żądania POST
$data = json_decode(file_get_contents("php://input"));

// Połączenie z bazą danych
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "test";

$conn = new mysqli($servername, $username, $password, $dbname);

// Wstawienie nowego zadania do bazy danych
$sql = "INSERT INTO tasks (task_name) VALUES ('" . $conn->real_escape_string($data->task_name) . "')";

if ($conn->query($sql) === TRUE) {
    // Pobranie ostatnio dodanego zadania z bazy danych
    $last_id = $conn->insert_id;
    $result = $conn->query("SELECT * FROM tasks WHERE id = $last_id");
    $row = $result->fetch_assoc();

    echo json_encode($row); // Zwrócenie dodanego zadania w formacie JSON
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
