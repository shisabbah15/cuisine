<?php
include 'config.php';

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $mot_de_passe = isset($_POST['mot_de_passe']) ? $_POST['mot_de_passe'] : '';

    $email = mysqli_real_escape_string($conn, $email);
    $mot_de_passe = mysqli_real_escape_string($conn, $mot_de_passe);

    $sql = "SELECT * FROM users WHERE mail='$email' AND password='$mot_de_passe'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        $_SESSION['email'] = $user['mail'];
        $_SESSION['initiales'] = $user['initiales'];
        header('Location: page.php');
        exit();
    } else {
        $error_message = "Email ou mot de passe incorrect.";
    }

    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link href="https://fonts.googleapis.com/css2?family=Italiana&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="connection.css">
</head>
<body>
<header>
    <nav>
        <ul>
            <li><a href="page.php">Accueil</a></li>
            <li><a href="#">Recettes</a></li>
            <li><a href="actus.php">Actus</a></li>
            <li><a href="top.php">Top 10</a></li>
        </ul>
    </nav>
</header>
<div class="video-container">
    <video autoplay muted loop>
        <source src="terre.mp4" type="video/mp4">
    </video>
    <div class="connection-container">
        <h2 class="connection-title">Connexion</h2>
        <?php
        if (isset($error_message)) {
            echo "<p style='color:red;'>$error_message</p>";
        }
        ?>
        <form action="" method="POST">
            <div class="input-container">
                <input type="email" name="email" placeholder="Email" required>
            </div>
            <div class="input-container">
                <input type="password" name="mot_de_passe" placeholder="Mot de passe" required>
            </div>
            <button type="submit" class="submit-btn">Se connecter</button>
        </form>
        <p>Pas encore inscrit? <a href="inscription.php">Cliquez ici</a></p>
    </div>
</div>
</body>
</html>
