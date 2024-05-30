<?php
include 'config.php';
session_start();

if (!isset($_SESSION['email'])) {
    header('Location: connexion.php');
    exit();
}

$email = $_SESSION['email'];
$sql = "SELECT nom, prenom FROM users WHERE mail='$email'";
$result = mysqli_query($conn, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    $user = mysqli_fetch_assoc($result);
    $nom = htmlspecialchars($user['nom']);
    $prenom = htmlspecialchars($user['prenom']);
} else {
    $nom = 'Nom inconnu';
    $prenom = 'Prénom inconnu';
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Utilisateur</title>
    <link href="https://fonts.googleapis.com/css2?family=Italiana&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="profil.css">
</head>
<body>
<header>
    <nav>
        <ul>
            <li><a href="page.php">Accueil</a></li>
            <li><a href="#RECETTES">Recettes</a></li>
            <li><a href="actus.php">Actus</a></li>
            <li><a href="top.php">Top 10</a></li>
        </ul>
        <a href="connection.php" class="icon-link"><img src="log.png" alt="Icone" class="icon"></a>
    </nav>
</header>
<div class="video-container">
    <video autoplay muted loop>
        <source src="terre.mp4" type="video/mp4">
    </video>
    <div class="profile-container">
        <div class="user-info">
            <h1>Profil utilisateur</h1>
            <div class="user-name"><?php echo $prenom; ?></div>
            <div class="user-name"><?php echo $nom; ?></div>
        </div>
    </div>
</div>
</body>
</html>

