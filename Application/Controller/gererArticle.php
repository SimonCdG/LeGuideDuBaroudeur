<?php
session_start();

include("{$_SERVER['DOCUMENT_ROOT']}/Application/Model/articlesModel.php");

if (!isset($_SESSION['user']) || !verifyArticleOwner($_SESSION['userid'], $_GET['id'])) {
    header("location: ../View/index/index.php");
    exit();
}

if (isset($_POST['modify']) && $_POST['modify'] == "Modifier l'article") {
    if ($_FILES['images']['error'][0] == UPLOAD_ERR_OK) {
        $title = $_POST['title'];
        $content = $_POST['content'];
        $imagesname = getImagesServerFromArticle($_GET['id'])['imagesname'];
        foreach ($imagesname as $image) {
            unlink(basename("../images/" . $image));
        }
        $imagesnames = [];
        for ($i = 0; $i < count($_FILES["images"]["name"]); $i++) {
            $imagename = "article" . $_GET['id'] . "_" . $i . "." . pathinfo($_FILES['images']['name'][$i], PATHINFO_EXTENSION);
            $save_path = __DIR__ . "/../images/" . $imagename;
            move_uploaded_file(basename($_FILES["images"]["tmp_name"][$i]), basename($save_path));
            $imagesnames[] = $imagename;
        }
        modifyArticle($imagesnames, $title, $content, $_GET['id']);
        header("location: ../View/index/index.php");
    } else {
        $imagesname = getImagesServerFromArticle($_GET['id'])['imagesname'];
        $title = $_POST['title'];
        $content = $_POST['content'];
        modifyArticle($imagesname, $title, $content, $_GET['id']);
        header("location: ../View/index/index.php");
    }
}


if (isset($_POST['delete']) && $_POST['delete'] == "SUPPRIMER") {
    $articleid = $_GET['id'];
    $imagesname = getImagesServerFromArticle($articleid);
    foreach ($imagesname as $image) {
        $dir = __DIR__ . "/../images/" . $image;
        unlink(basename($dir));
    }
    deleteArticle($articleid);
    header("location: ../View/index/index.php");
}

