<?php
// Rozpocznij sesję
session_start();

// Sprawdź, czy użytkownik jest już zalogowany
if (isset($_SESSION['zalogowany']) && $_SESSION['zalogowany'] === true) {
    header('Location: dashboard.php'); // Przekieruj użytkownika na dashboard, jeśli jest już zalogowany
    exit();
}
require_once('connect.php');

// Obsługa formularza rejestracji
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Weryfikacja tokenu CSRF
    if (isset($_POST['csrf_token']) && $_POST['csrf_token'] === $_SESSION['csrf_token']) {
        $login = $_POST['login'];
        $haslo = $_POST['haslo'];

        // Zabezpieczamy dane przed atakami SQL Injection
        $login = $mysqli->real_escape_string($login);

        // Haszowanie hasła przed zapisaniem go w bazie danych
        $haslo_haszowane = password_hash($haslo, PASSWORD_DEFAULT);

        // Dodawanie nowego użytkownika do bazy danych
        $stmt = $mysqli->prepare("INSERT INTO users (username, passwd) VALUES (?, ?)");
        $stmt->bind_param("ss", $login, $haslo_haszowane);

        if ($stmt->execute()) {
            // Rejestracja udana, przekierowujemy użytkownika na inną stronę
            $_SESSION['zalogowany'] = true;
            header('Location: dashboard.php');
            exit();
        } else {
            // Błąd przy rejestracji
            $registration_error = 'Błąd przy rejestracji. Proszę spróbować ponownie.';
        }
    } else {
        // Błąd CSRF
        $registration_error = 'Błąd CSRF. Proszę spróbować ponownie.';
    }
}

// Generowanie i zapisywanie nowego tokenu CSRF
$csrf_token = bin2hex(random_bytes(32));
$_SESSION['csrf_token'] = $csrf_token;
?>

<!DOCTYPE html>
<html>
<head>
    <title>Formularz rejestracji</title>
</head>
<body>
    <h2>Formularz rejestracji</h2>
    <?php if (isset($registration_error)): ?>
        <p><?php echo $registration_error; ?></p>
    <?php endif; ?>
    <form method="post" action="">
        <input type="hidden" name="csrf_token" value="<?php echo $csrf_token; ?>">
        
        <label for="login">Login:</label>
        <input type="text" id="login" name="login" required><br><br>

        <label for="haslo">Hasło:</label>
        <input type="password" id="haslo" name="haslo" required><br><br>

        <input type="submit" value="Zarejestruj">
    </form>
</body>
</html>
