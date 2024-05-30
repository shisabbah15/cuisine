<?php
include 'config.php';
session_start();

// Supposons que vous ayez les initiales de l'utilisateur stockées dans la session
// Exemple : $_SESSION['initiales'] = 'JD';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Site</title>
    <link rel="stylesheet" href="page.css">
    <link href="https://fonts.googleapis.com/css2?family=Italiana&display=swap" rel="stylesheet">
</head>
<body>
<header>
    <div class="hero">
        <video autoplay muted loop>
            <source src="terre.mp4" type="video/mp4">
        </video>
        <div class="header-content">
            <nav>
                <ul>
                    <li><a href="#"><?php echo "Accueil"; ?></a></li>
                    <li><a href="#RECETTES"><?php echo "Recettes"; ?></a></li>
                    <li><a href="actus.php"><?php echo "Actus"; ?></a></li>
                    <li><a href="top.php"><?php echo "Top 10"; ?></a></li>
                </ul>
                <?php if (isset($_SESSION['initiales'])): ?>
                    <div class="user-initials" id="profileIcon" style="cursor: pointer;"><?php echo htmlspecialchars($_SESSION['initiales']); ?></div>
                <?php else: ?>
                    <a href="connection.php" class="icon-link"><img src="co.png" alt="Icone" class="icon"></a>
                <?php endif; ?>
            </nav>
            <h1><?php echo "Cuisine du monde"; ?></h1>
        </div>
    </div>
</header>
<section class="content">
    <div class="container">
        <div class="story">
            <h2><?php echo "Notre Histoire"; ?></h2>
            <p><?php echo "Voyageuse passionnée et amatrice de saveurs exotiques,
                je m'évade à travers les recettes du monde depuis ma cuisine.
                Chaque plat devient une porte ouverte vers un nouveau pays, chaque bouchée une aventure gustative.
                Inspirée par mes voyages virtuels, je laisse libre cours à ma créativité culinaire pour explorer 
                des horizons lointains, un repas à la fois."; ?></p>
        </div>
    </div>
</section>
<section id="RECETTES">
<section class="recette-section">
    <div class="container">
        <h1>Recettes</h1>
        <div id="image-container">
            <?php
            $images = [
                '1.png', '2.png', '3.png', '4.png', '5.png',
                '6.png', '7.png', '8.png', '9.png', '10.png',
                '11.png', '12.png', '13.png', '14.png', '15.png',
                '16.png', '17.png', '18.png', '19.png', '20.png',
                '21.png', '22.png', '23.png', '24.png', '25.png',
                '26.png', '27.png', '28.png', '29.png', '30.png',
                '31.png', '32.png', '33.png', '34.png', '35.png',
                '36.png'
            ];

            for ($i = 0; $i < 5; $i++): ?>
                <div class="image-row">
                    <?php for ($j = 0; $j < 4; $j++):
                        $index = $i * 4 + $j;
                        if ($index < count($images)): ?>
                            <img src="<?php echo $images[$index]; ?>" alt="Image <?php echo $index + 1; ?>" class="clickable-image">
                        <?php endif; ?>
                    <?php endfor; ?>
                </div>
            <?php endfor; ?>
        </div>
        <button id="load-more">Plus</button>
    </div>
</section>
</section>
<script>
    document.getElementById('load-more').addEventListener('click', function() {
        const imageContainer = document.getElementById('image-container');
        const images = [
            '1.png', '2.png', '3.png', '4.png', '5.png',
            '6.png', '7.png', '8.png', '9.png', '10.png',
            '11.png', '12.png', '13.png', '14.png', '15.png',
            '16.png', '17.png', '18.png', '19.png', '20.png',
            '21.png', '22.png', '23.png', '24.png', '25.png',
            '26.png', '27.png', '28.png', '29.png', '30.png',
            '31.png', '32.png', '33.png', '34.png', '35.png',
            '36.png'
        ];
        const currentImageCount = imageContainer.getElementsByTagName('img').length;
        if (currentImageCount >= 36) {
            alert('Vous avez atteint le nombre maximum d\'images.');
            return;
        }
        for (let i = 0; i < 2; i++) {
            const row = document.createElement('div');
            row.className = 'image-row';
            for (let j = 0; j < 4; j++) {
                const index = currentImageCount + i * 4 + j;
                if (index < images.length) {
                    const img = document.createElement('img');
                    img.className = 'clickable-image';
                    img.src = images[index];
                    img.alt = 'Additional Image ' + (index + 1);
                    row.appendChild(img);
                }
            }
            imageContainer.appendChild(row);
        }
        if (imageContainer.getElementsByTagName('img').length >= 36) {
            document.getElementById('load-more').disabled = true;
            document.getElementById('load-more').innerText = 'Aucun autre contenu';
        }
    });

    document.addEventListener('click', function (event) {
        if (event.target.classList.contains('clickable-image')) {
            if (event.target.classList.contains('expanded')) {
                event.target.classList.remove('expanded');
                document.body.classList.remove('expanded');
            } else {
                document.querySelectorAll('.clickable-image.expanded').forEach(function (img) {
                    img.classList.remove('expanded');
                });
                event.target.classList.add('expanded');
                document.body.classList.add('expanded');
            }
        }
    });

    // Redirection vers profil.php lorsque l'utilisateur clique sur ses initiales
    document.getElementById('profileIcon')?.addEventListener('click', function() {
        window.location.href = 'profil.php';
    });
</script>
</body>
</html>
