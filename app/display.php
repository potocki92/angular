<?php
require "connect.php";

// Ustawianie nagłówków CORS
header("Access-Control-Allow-Origin: http://localhost:8000");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS"); // Dodaj wszystkie obsługiwane metody
header("Access-Control-Allow-Headers: Content-Type");

if($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    header("HTTP/1.1 200 OK");
    exit;
}


$table_name = 'todos';
$query = "SELECT * FROM users";
$result = mysqli_query($conn, $query);
$data = array();

if (!$result) {
    $response = array('error' => 'Błąd zapytania: ' . mysqli_error($conn));
} else {
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }

    mysqli_close($conn);
    $response = array('data' => $data);
}

$jsonResponse = json_encode($response);
header('Content-Type: application/json');
echo json_encode($response);
?>
