<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Se connecter</title>
</head>
<body>
<!-- Header -->
<?php include('navbar.php') ?>

<!-- Content -->
<form method="post">
    <label>Nom d'utilisateur
        <input type="text" name="username"></label>
    <label>Mot de passe
        <input type="password" name="password"></label>
    <input name="submit" type="submit" value="Se connecter">
</form>

<!-- Footer -->

</body>
</html>