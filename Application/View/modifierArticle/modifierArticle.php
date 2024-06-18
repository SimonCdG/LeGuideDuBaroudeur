<?php
session_start();

include("{$_SERVER['DOCUMENT_ROOT']}/Application/Model/articlesModel.php");

$id = htmlspecialchars($_GET['id']);
$data = showArticle($id);
$articles2 = showArticles();
?>

<!doctype html>
<html lang="fr" xmlns:input="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Modifier</title>
    <link rel="stylesheet" href="modifierArticle.css">
    <link rel="stylesheet" href="../navbar/navbar.css">
    <link rel="stylesheet" href="../footer/footer.css">
</head>
<body>
<div class="wrapper">
    <?php include("{$_SERVER['DOCUMENT_ROOT']}/Application/View/navbar/navbar.php") ?>

    <main>
        <div class="form-container">
            <form class="article-form" enctype="multipart/form-data" method="post" action="../../Controller/gererArticle.php?id=<?php echo $id ?>">
                <label for="title">Titre de l'article</label>
                <input type="text" id="title" name="title" required>

                <label for="content">Contenu de l'article</label>
                <textarea id="content" name="content" rows="10" required></textarea>

                <label for="images">Images</label>
                <input type="file" id="images" name="images[]" multiple>

                <button type="submit" name="modify" value="Modifier l'article">Modifier l'article</button>
            </form>
        </div>
    </main>
    <?php include("{$_SERVER['DOCUMENT_ROOT']}/Application/View/footer/footer.html") ?>
</div>

<script>
    let dataFromPHP = <?php echo json_encode($data); ?>;

    document.getElementById('title').setAttribute('value', dataFromPHP.title);
    document.getElementById('content').innerHTML = dataFromPHP.content;
</script>
</body>
</html>