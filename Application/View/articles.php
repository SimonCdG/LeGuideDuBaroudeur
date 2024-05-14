<?php session_start();
include('../Model/articlesModel.php');
$articles = showArticles();
?>

<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Articles</title>
</head>
<body>
<!-- Header -->
<?php include('navbar.php') ?>

<!-- Content -->
<?php if ($_SESSION["loggedin"]) : ?>
    <button onclick="document.location.href = '../Controller/creationArticleController.php'">Créer un article</button>
<?php endif;

foreach ($articles as $article): ?>
    <h2><?php echo $article["title"] ?></h2>
    <img src="../images/<?php echo $article['imagename'] ?>" alt="image" style="width: 100px; height: auto">
    <p><?php echo $article["content"] ?></p>
    <?php if (verifyArticleOwner($_SESSION['userid'], $article['articleid'])): ?>
        <form action="../Controller/gererArticle.php?id=<?php echo $article['articleid'] ?>" method="post">
            <input type="submit" name="modif" value="Modifier l'article">
            <input type="submit" name="delete" value="Supprimer l'article">
        </form>
    <?php endif; ?>
<?php endforeach; ?>

<!-- Footer -->

</body>
</html>