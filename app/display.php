<?php
require "connect.php";

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
