<?php
// Dane dostępowe do bazy danych
$servername = "localhost";
$username = "root";
$password = ""; // Domyślne hasło w XAMPP jest puste
$dbname = "test";

// Połącz z bazą danych
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Sprawdź połączenie
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Zapytanie SQL
$sql = "SELECT * FROM users";
$result = mysqli_query($conn, $sql);

// Tablica na dane użytkowników
$users = [];

// Sprawdź czy są wyniki
if (mysqli_num_rows($result) > 0) {
    // Wyświetl dane dla każdego wiersza
    while ($row = mysqli_fetch_assoc($result)) {
        $users[] = $row;
    }
}

// Zwolnij zasoby
mysqli_free_result($result);

// Zamknij połączenie
mysqli_close($conn);

// Zwróć dane w formacie JSON
echo json_encode($users);
?>
