<?php

// if($_SERVER['REQUEST_METHOD'] == 'POST'){

//     $connection = mysqli_connect("localhost:3307","root","","test");
//     if(!$connection){
//         die("Error ". mysqli_connect_error());
//     }
//    $name = $_POST["name"];
//    $email = $_POST["email"];

//    echo "<p>Name: $name</p>";
//    $sql = "INSERT INTO test (name, email) VALUES ('$name','$email')";

//    if($connection->query($sql) === TRUE){
//     echo "New record created successfully";
//    } else {
//     echo "Error: " . $sql . "<br>" . $connection->error;
//    }

//    $connection->close();
// }

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    echo json_encode($data);
}
?>