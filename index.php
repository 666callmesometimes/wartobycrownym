<?php
// Rozpocznij sesję
session_start();

// Sprawdź, czy użytkownik jest już zalogowany
if (isset($_SESSION['zalogowany']) && $_SESSION['zalogowany'] === true) {
    header('Location: dashboard.php'); // Przekieruj użytkownika na dashboard, jeśli jest już zalogowany
    exit();
}

require_once('connect.php');

// Obsługa formularza logowania
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Weryfikacja tokenu CSRF
    if (isset($_POST['csrf_token']) && $_POST['csrf_token'] === $_SESSION['csrf_token']) {
        $login = $_POST['login'];
        $haslo = $_POST['haslo'];

        // Zabezpieczamy dane przed atakami SQL Injection
        $login = $mysqli->real_escape_string($login);
        $haslo = $mysqli->real_escape_string($haslo);

        // Zapytanie do bazy danych w celu sprawdzenia poprawności danych logowania
        $stmt = $mysqli->prepare("SELECT * FROM users WHERE username=?");
        $stmt->bind_param("s", $login);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            if (password_verify($haslo, $row['passwd'])) {
                // Poprawne logowanie, przekierowujemy użytkownika na inną stronę
                $_SESSION['zalogowany'] = true;
                header('Location: dashboard.php');
                exit();
            } else {
                // Błędne hasło
                $login_error = 'Błędne hasło. Spróbuj ponownie.';
            }
        } else {
            // Brak użytkownika o podanym loginie
            $login_error = 'Brak użytkownika o podanym loginie.';
        }
    } else {
        // Błąd CSRF
        $login_error = 'Błąd CSRF. Proszę spróbować ponownie.';
    }
}

// Generowanie i zapisywanie nowego tokenu CSRF
$csrf_token = bin2hex(random_bytes(32));
$_SESSION['csrf_token'] = $csrf_token;
?>

<!DOCTYPE html>
<html>
<head>
    <title>Formularz logowania</title>
</head>
<body>
    <h2>Formularz logowania</h2>
    <?php if (isset($login_error)): ?>
        <p><?php echo $login_error; ?></p>
    <?php endif; ?>
    <form method="post" action="">
        <input type="hidden" name="csrf_token" value="<?php echo $csrf_token; ?>">
        
        <label for="login">Login:</label>
        <input type="text" id="login" name="login" required><br><br>
        <label for="haslo">Hasło:</label>
        <input type="password" id="haslo" name="haslo" required><br><br>
        <input type="checkbox" id="show-password" onclick="showPassword()">Show password<br><br>
        <input type="submit" value="Zaloguj">
    </form>
        <p>Nie masz konta? <a href="register.php">Zarejstruj się.</a></p>
    <script>
        function showPassword() {
            var passwordInput = document.getElementById("haslo");
            var showPasswordCheckbox = document.getElementById("show-password");

            if (showPasswordCheckbox.checked) {
                passwordInput.type = "text";
            } else {
                passwordInput.type = "password";
            }
        }
    </script>
</body>
</html>
