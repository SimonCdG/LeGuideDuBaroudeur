<?php session_start();
include('../../Model/articlesModel.php');

$id = htmlspecialchars($_GET['id']);
$article = showArticle($id);
$articles2 = showArticles();
?>

<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Articles</title>
    <link rel="stylesheet" href="articles.css">
    <link rel="stylesheet" href="../navbar/navbar.css">
    <link rel="stylesheet" href="../footer/footer.css">
</head>
<body>
<div class="wrapper">
    <!-- Header -->
    <?php include("{$_SERVER['DOCUMENT_ROOT']}/Application/View/navbar/navbar.php") ?>

    <?php if (isset($_SESSION['user']) && verifyArticleOwner($_SESSION['userid'], $id)): ?>
        <div class="modify-delete-container">
            <form class="form-modify" method="post" action="../../Controller/gererArticle.php?id=<?php echo $id ?>">
                <input type="button" class="modify-button" value="Modifier" onclick="document.location.href='../modifierArticle/modifierArticle.php?id=<?php echo $id ?>'">
                <div id="button-container" class="button-container">
                    <input id="delete-button" class="delete-button" type="button" value="Supprimer" onclick="extend()">
                    <input id="delete-submit" class="delete-submit-hidden" type="submit" name="delete" value="SUPPRIMER">
                    <input id="cancel-button" class="cancel-button-hidden" type="button" value="Annuler" onclick="smaller()">
                </div>
            </form>
        </div>
    <?php endif; ?>

    <!-- Content -->
    <main>
        <div class="article-container">
            <div class="container">
                <h1><?php echo $article['title'] ?></h1>
                <div class="content">
                    <div class="text">
                        <p><?php echo $article['content'] ?></p>
                    </div>
                    <div class="images">
                        <div class="main-image">
                            <img src="../../images/<?php echo $article['imagesname'][0] ?>" alt="Grande image">
                        </div>
                        <div class="thumbnail-images">
                            <img src="../../images/<?php echo $article['imagesname'][1] ?>" alt="Petite image 1">
                            <img src="../../images/<?php echo $article['imagesname'][2] ?>" alt="Petite image 2">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <?php include("{$_SERVER['DOCUMENT_ROOT']}/Application/View/footer/footer.html") ?>
</body>

<script src="articles.js"></script>
</html>