<?php
include 'config.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $prenom = isset($_POST['prenom']) ? $_POST['prenom'] : '';
    $nom = isset($_POST['nom']) ? $_POST['nom'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $mot_de_passe = isset($_POST['mot_de_passe']) ? $_POST['mot_de_passe'] : '';


    $prenom = mysqli_real_escape_string($conn, $prenom);
    $nom = mysqli_real_escape_string($conn, $nom);
    $email = mysqli_real_escape_string($conn, $email);
    $mot_de_passe = mysqli_real_escape_string($conn, $mot_de_passe);


    $check_email_query = "SELECT * FROM users WHERE mail='$email'";
    $result = mysqli_query($conn, $check_email_query);

    if (mysqli_num_rows($result) > 0) {
        echo "Erreur: cet email est déjà utilisé. Veuillez utiliser un autre email.";
    } else {

        $sql = "INSERT INTO users (Nom, Prenom, mail, password) VALUES ('$nom', '$prenom', '$email', '$mot_de_passe')";

        if (mysqli_query($conn, $sql)) {

            header('Location: page.php');
            exit();
        } else {
            echo "Erreur: " . $sql . "<br>" . mysqli_error($conn);
        }
    }
    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link href="https://fonts.googleapis.com/css2?family=Italiana&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="inscription.css">
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
    <div class="inscription-container">
        <h2 class="inscription-title">Inscription</h2>
        <form action="" method="POST">
            <div class="input-container">
                <input type="text" name="prenom" placeholder="Prénom" required>
            </div>
            <div class="input-container">
                <input type="text" name="nom" placeholder="Nom" required>
            </div>
            <div class="input-container">
                <input type="email" name="email" placeholder="Email" required>
            </div>
            <div class="input-container">
                <input type="password" name="mot_de_passe" placeholder="Mot de passe" required>
            </div>
            <button type="submit" class="submit-btn">S'inscrire</button>
        </form>
        <p>Vous avez déjà un compte? <a href="connection.php">Cliquez ici</a></p>
    </div>
</div>
</body>
</html>