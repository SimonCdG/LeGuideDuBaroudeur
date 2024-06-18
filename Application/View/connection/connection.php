<?php
session_start();
include("{$_SERVER['DOCUMENT_ROOT']}/Application/Model/articlesModel.php");

$articles2 = showArticles();
?>

<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Se connecter</title>
    <link rel="stylesheet" href="../../../Application/View/navbar/navbar.css">
    <link rel="stylesheet" href="../../../Application/View/connection/connection.css">
    <link rel="stylesheet" href="../../../Application/View/footer/footer.css">
</head>
<body>
<div class="wrapper">
    <!-- Header -->
    <?php include("{$_SERVER['DOCUMENT_ROOT']}/Application/View/navbar/navbar.php") ?>

    <!-- Content -->
    <main>
        <div class="login-form-container">
            <form class="login-form" method="post" action="">
                <label for="username">Identifiant</label>
                <input type="text" id="username" name="username" required>

                <label for="password">Mot de passe</label>
                <input type="password" id="password" name="password" required>

                <input class="submit" type="submit" name="submit" value="Se connecter">
            </form>
        </div>
    </main>

    <!-- Footer -->
    <?php include("{$_SERVER['DOCUMENT_ROOT']}/Application/View/footer/footer.html") ?>
</div>
</body>
</html>