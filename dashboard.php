<?php
// Rozpocznij lub wznow sesję
session_start();

require_once('connect.php');

// Sprawdź, czy użytkownik jest zalogowany
if (!isset($_SESSION['zalogowany']) || $_SESSION['zalogowany'] !== true) {
    header('Location: index.php'); // Przekieruj użytkownika na stronę logowania, jeśli nie jest zalogowany
    exit();
}

// Obsługa wylogowania
if (isset($_POST['wyloguj'])) {
    session_destroy(); // Zniszcz sesję (wyloguj użytkownika)
    header('Location: index.php'); // Przekieruj użytkownika na stronę logowania po wylogowaniu
    exit();
}


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['utworz_post'])) {
    $title = $_POST['title'];
    $content = $_POST['content'];

    // Wprowadź dane do bazy danych (tabela posts)
    $stmt = $mysqli->prepare("INSERT INTO posts (title, content) VALUES (?, ?)");
    $stmt->bind_param("ss", $title, $content);

    if ($stmt->execute()) {
        $message = 'Post został dodany pomyślnie.';
    } else {
        $error = 'Błąd przy dodawaniu posta: ' . $stmt->error;
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>

    </style>
</head>
<body>
    <form method="post" action="">
        <input type="submit" name="wyloguj" value="Wyloguj">
    </form>
    <h1>Dashboard</h1>
    <p>Tu znajdziesz treść dostępną tylko dla zalogowanych użytkowników.</p>

    <form method="post" action="">
    <label for="title">Tytuł:</label><br>
    <input type="text" id="title" name="title" required><br><br>

    <label for="content">Treść:</label><br>
    <textarea id="content" name="content" required></textarea><br><br>

    <input type="submit" name="utworz_post" value="Utwórz post">

    <?php 
    
    
    ?>
</form>
</body>
</html>
