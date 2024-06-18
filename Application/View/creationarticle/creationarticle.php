<?php
session_start();
include('../../Model/articlesModel.php');

$articles2 = showArticles();
?>

<!doctype html>
<html lang="fr" xmlns:input="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Créer un article</title>
    <link rel="stylesheet" href="../../../../LeGuideDuBaroudeur/Application/View/creationarticle/creationarticle.css">
    <link rel="stylesheet" href="../../../../LeGuideDuBaroudeur/Application/View/navbar/navbar.css">
    <link rel="stylesheet" href="../../../../LeGuideDuBaroudeur/Application/View/footer/footer.css">
</head>
<body>
<div class="wrapper">
    <?php include("{$_SERVER['DOCUMENT_ROOT']}/Application/View/navbar/navbar.php") ?>

    <main>
        <div class="form-container">
            <form class="article-form" enctype="multipart/form-data" method="post">
                <label for="title">Titre de l'article</label>
                <input type="text" id="title" name="title" required>

                <label for="content">Contenu de l'article</label>
                <textarea id="content" name="content" rows="10" required></textarea>

                <label for="images">Images</label>
                <input type="file" id="images" name="images[]" multiple>

                <button type="submit" name="save" value="Créer l'article">Créer l'article</button>
            </form>
        </div>
    </main>

    <?php include("{$_SERVER['DOCUMENT_ROOT']}/Application/View/footer/footer.html") ?>

</div>
</body>
</html>