<?php
session_start();

include("{$_SERVER['DOCUMENT_ROOT']}/Application/Model/articlesModel.php");
include("{$_SERVER['DOCUMENT_ROOT']}/Application/View/creationarticle/creationarticle.php");

if (!isset($_SESSION['user'])) {
    header("Location: {$_SERVER['DOCUMENT_ROOT']}/Application/View/index/index.php");
    exit();
}

if (isset($_POST['save']) && $_POST['save'] == "Créer l'article") {
    if ($_FILES['images']['error'][0] == UPLOAD_ERR_OK) {
        $title = $_POST['title'];
        $content = $_POST['content'];
        $newarticleid = newArticleId() + 1;
        $imagesname = [];
        for ($i = 0; $i < count($_FILES["images"]["name"]); $i++) {
            $imagename = "article" . $newarticleid . "_" . $i . "." . pathinfo($_FILES['images']['name'][$i], PATHINFO_EXTENSION);
            $save_path = __DIR__ . "/../images/" . $imagename;
            move_uploaded_file(basename($_FILES["images"]["tmp_name"][$i]), basename($save_path));
            $imagesname[] = $imagename;
        }
        newArticle($imagesname, $title, $content, $_SESSION['userid']);
        header("Location: {$_SERVER['DOCUMENT_ROOT']}/Application/View/index/index.php");
    }
}