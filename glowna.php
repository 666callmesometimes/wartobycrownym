<?php
// Pobieranie postów z bazy danych (tabela posts)
require_once('connect.php');

$posts_query = "SELECT * FROM posts";
$result = $mysqli->query($posts_query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Strona główna - Fundacja warto być równym nad Wartą</title>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" href="img/logo2.png" type="image/x-icon">

</head>
<body>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
    <header>
        <a href="index.html"><img src="img/logo2.png" alt="Fundacja Warto być równym nad Wartą"></a>
        <nav class="off">
            <a href="index.html#home">Strona główna</a>
            <a href="index.html#onas">O nas</a>
            <a href="index.html#kontakt">Kontakt</a>
            <a href="wesprzyjnas.html">Wesprzyj nas</a>
        </nav>
        <div class="burger">
            <img src="img/menu.png" alt="menu">
        </div>
    </header>
    <main>
        <section id="home">
            <h2 data-aos="fade-right" data-aos-delay="300">Fundacja Warto być równym nad Wartą</h2>
            <h6 data-aos="fade-right" data-aos-delay="400">Bezpieczna przestrzeń nad Wartą.</h6>
            <div data-aos="fade-right" data-aos-delay="500" class="home-image"></div>
        </section>
        <section id="onas">
            <div class="left" data-aos="fade-right" data-aos-delay="300">
                <h2>O nas</h2>
                <div class="articles">
                <?php
// Inicjalizacja tablicy na wyniki
$posts = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Dodawanie każdego wiersza do tablicy
        $posts[] = $row;
    }

    // Odwracanie tablicy, aby wyświetlać w odwrotnej kolejności
    $posts = array_reverse($posts);

    foreach ($posts as $post) {
        echo '<div class="article">';
        echo '<br>';
        echo '<h4>' . $post['title'] . '</h4>';
        echo '<p>' . $post['content'] . '</p>';
        echo '<hr>';
        echo '</div>';
    }
} else {
    echo 'Brak postów do wyświetlenia.';
}
?>

                   </div>
            </div>
            <div class="right" data-aos="fade-left" data-aos-delay="300">
                <div class="administracja">
                    <h3>Administracja</h3>
                    <div class="adm-item">
                        <div class="adm-picture pic1"></div>
                        <span>
                            <h4>Monika Drubkowska</h4>
                            <p class="position">Prezeska Fundacji</p>
                        </span>
                    </div>
                    <div class="adm-item">
                        <div class="adm-picture pic2"></div>
                        <span>
                            <h4>Monika Drubkowska</h4>
                            <p class="position">Prezeska Fundacji</p>
                        </span>
                    </div>
                    <div class="adm-item">
                        <div class="adm-picture pic3"></div>
                        <span>
                            <h4>Monika Drubkowska</h4>
                            <p class="position">Prezeska Fundacji</p>
                        </span>
                    </div>
                </div>
                <div class="sociale">
                    <h3>Nasze sociale</h3>
                    <div class="soc-item">
                        <div class="soc-img-box">
                            <div class="soc-img-1"></div>
                        </div>
                        <h4>WartoNadWarta</h4>
                    </div>
                    <div class="soc-item">
                        <div class="soc-img-box">
                            <div class="soc-img-2"></div>
                        </div>
                        <h4>gorzowskafundacjalgbt</h4>
                    </div>
                    <div class="soc-item">
                        <div class="soc-img-box">
                            <div class="soc-img-3"></div>
                        </div>
                        <h4>wartobycrownym</h4>
                    </div>
                </div>
            </div>
        </section>
        <section id="kontakt">
            <h2 data-aos="fade-right" data-aos-delay="100">Skontaktuj się z nami</h2>
            <div class="contact">
                <div class="map" data-aos="fade-right" data-aos-delay="300">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2416.098651571726!2d15.237916777213899!3d52.73041222062933!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47071f17c77585e9%3A0x16f84ca23c0b0f95!2sFundacja%20Warto%20by%C4%87%20r%C3%B3wnym%20nad%20Wart%C4%85!5e0!3m2!1spl!2spl!4v1692624891318!5m2!1spl!2spl" width="700" height="700" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
                <form method="POST" data-aos="fade-left" data-aos-delay="300">
                    <span>
                        <label for="name">Twoje Imię</label>
                        <input type="text" name="name" id="name" placeholder="Tutaj wpisz swoje imię..." required>    
                    </span>
                    <span>
                        <label for="email">Twój Adres Mailowy</label>
                        <input type="text" name="email" id="email" placeholder="Tutaj wpisz swój adres mailowy..." required> 
                    </span>
                    <span>
                        <label for="message">Twoja wiadomość</label>
                        <textarea name="message" id="message" placeholder="Tutaj napisz swoją wiadomość..." required></textarea>    
                    </span>
                   <input type="submit" value="Wyślij">
                </form>
            </div>
        </section>
    </main>
    <footer>
        <div class="top">
            <div class="footer-left">
                <img src="img/logo.png" alt="Warto być równym nad Wartą">
                <h5>Fundacja Warto być równym nad Wartą</h5>
                <p>ul. Lutycka 8, 66-400 Gorzów Wielkopolski</p>
                <div class="footer-span">
                    <span>
                        <p><b>KRS</b> 0000823982</p>
                        <p><b>NIP</b> 599 324 63 86</p>
                        <p><b>REGON</b> 3385319401</p>
                    </span>
                    <span>
                        <p>rownoscwgorzowie@gmail.com</p>
                        <p>+48 609 298 879</p>
                    </span>
                </div>
                <div class="footer-sociale">
                    <a href="#"><img src="img/facebook.png" alt="facebook"></a>
                    <a href="#"><img src="img/instagram.png" alt="instagram"></a>
                    <a href="#"><img src="img/tiktok.png" alt="tiktok"></a>
                </div>
            </div>
            <div class="footer-right">
                <span>
                    <a href="index.html#home">Strona główna</a>
                    <a href="index.html#onas">O nas</a>
                    <a href="index.html#kontakt">Kontakt</a>
                    <a href="wesprzyjnas.html">Wesprzyj nas</a>
                </span>
                <span>
                    <a href="#">Statut</a>
                    <a href="#">Sprawozdania</a>
                    <a href="index.html#onas">Zarząd</a>
                    <a href="#">Telefon zaufania</a>
                </span>
            </div>
        </div>
        <div class="bottom">
            <p class="bottom-text">Warto być równym nad Wartą &#169; 2023 | <a href="index.php">Zaloguj</a></p>
            <p class="bottom-text">Strona stworzona dzięki uprzejmości <a href="https://www.michaelbadocha.pl/">Michael Badocha Studio</a> </p>
        </div>
    </footer>
    <script src="app.js"></script>

    <?php
    if(isset($_POST['name'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $msg = $_POST['message'];
    

    $to = 'mibado03@gmail.com';
    $from = 'Fundacja Warto być równym nad Wartą Mailing bot <michaelbadocha.noreply@gmail.com>';
    $replyTo = 'Fundacja Warto być równym nad Wartą <michaelbadocha.inbox@gmail.com>';
    $subject = 'Nowa wiadomość ze strony Warto być równym nad Wartą!';

    $message = 
    '<h2>Otrzymana wiadomość: </h2> Imię: ' . $name . "<br>\n\n" .
    'E-mail: ' . $email . "<br>\n\n" .
    'Wiadomość: ' . $msg;

    $headers  = 'MIME-Version: 1.0'."\r\n";
    $headers .= 'Content-Type: text/html; charset=utf-8'."\r\n";
    $headers .= 'From: '.$from."\r\n";
    $headers .= 'Reply-To: '.$replyTo."\r\n";

    mail($to, $subject, $message, $headers);
    }
    ?>
</body>
</html>