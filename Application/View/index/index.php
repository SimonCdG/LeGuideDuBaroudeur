<?php
session_start();

include('../../../../LeGuideDuBaroudeur/Application/Model/articlesModel.php');
$articles = getArticleForCarrousel();
$articles2 = showArticles();

if (isset($_GET['logout']) && $_GET['logout'] == 1) {
    session_destroy();
}
?>

<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Accueil</title>
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="../navbar/navbar.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstaticèé.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300..900;1,300..900&display=swap"
          rel="stylesheet">
    <link rel="stylesheet" href="../footer/footer.css">
</head>
<body>
<div class="wrapper">
    <!-- Header -->
    <?php include("{$_SERVER['DOCUMENT_ROOT']}/Application/View/navbar/navbar.php") ?>

    <?php if (isset($_SESSION['user'])): ?>
        <div class="article-creation">
            <a class="article-createbutton" href="../../../../LeGuideDuBaroudeur/Application/Controller/creationArticleController.php">Créer un article</a>
        </div>
    <?php endif ?>

    <!-- Carrousel -->
    <main>
        <div class="carousel">
            <button class="carousel-button prev">&#8249;</button>
            <div class="carousel-images-wrapper">
                <div class="carousel-images">
                    <?php foreach ($articles as $article): ?>
                        <div class="carousel-image">
                            <img src="../../images/<?php echo $article[0] ?>" alt="image">
                            <div class="caption">
                                <h2><?php echo $article[2] ?></h2>
                                <p><?php echo $article[1] ?></p>
                            </div>
                        </div>
                    <?php endforeach ?>
                </div>
            </div>
            <button class="carousel-button next">&#8250;</button>
        </div>
    </main>

    <!-- Footer -->
    <?php include("{$_SERVER['DOCUMENT_ROOT']}/Application/View/footer/footer.html") ?>
</div>

<script>
    let currentIndex = 0;

    const images = document.querySelectorAll('.carousel-image');
    const totalImages = images.length;

    const prevButton = document.querySelector('.carousel-button.prev');
    const nextButton = document.querySelector('.carousel-button.next');

    prevButton.addEventListener('click', () => {
        currentIndex = (currentIndex === 0) ? totalImages - 1 : currentIndex - 1;
        updateCarousel();
    });

    nextButton.addEventListener('click', () => {
        currentIndex = (currentIndex === totalImages - 1) ? 0 : currentIndex + 1;
        updateCarousel();
    });

    function updateCarousel() {
        const offset = -currentIndex * 100;
        document.querySelector('.carousel-images').style.transform = `translateX(${offset}%)`;
    }
</script>

</body>
</html>
