<?php
require_once "DBModel.php";
require_once "DBController.php";

// Ustawianie nagłówków CORS
header("Access-Control-Allow-Origin: http://localhost:8000");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS"); // Dodaj wszystkie obsługiwane metody
header("Access-Control-Allow-Headers: Content-Type");

if($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    header("HTTP/1.1 200 OK");
    exit;
}

$dbHost = "localhost:3306";
$dbName = "test";
$dbUsername = "root";
$dbPassword = "";
$db = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUsername, $dbPassword);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$tableName = 'todos';
$dbModel = new DBModel($db);
$dbController = new DBController($dbModel, $tableName);

if(isset($_REQUEST['type']) && !empty($_REQUEST['type'])) {
    $type = $_REQUEST['type'];
    match($type) {
        'view' => $dbController->getTodos(),
        'add' => $dbController->addTodo(),
        'edit' => $dbController->editTodo(),
        'update' => $dbController->updateTodo(),
        'delete' => $dbController->deleteTodo(),
        default => die('Invalid type parameter'),
    };
}
?>
