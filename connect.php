<?php
$host = 'localhost'; // Nazwa hosta
$username = 'root'; // Nazwa użytkownika
$password = ''; // Hasło użytkownika
$database = 'logowanie'; // Nazwa bazy danych

// Tworzymy połączenie z bazą danych
$mysqli = new mysqli($host, $username, $password, $database);

// Sprawdzamy, czy udało się połączyć z bazą danych
if ($mysqli->connect_error) {
    die('Błąd połączenia z bazą danych: ' . $mysqli->connect_error);
}
?>