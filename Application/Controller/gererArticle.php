<?php
session_start();
include('../Model/articlesModel.php');

if (!isset($_SESSION['user']) || !verifyArticleOwner($_SESSION['userid'], $_GET['id'])) {
    header("Location: ../View/index.php");
    exit();
}

include('../View/modifierArticle.html');

$upload_dir = getcwd() . DIRECTORY_SEPARATOR . '../images/';

if (isset($_POST['modify']) && $_POST['modify'] == "Modifier l'article") {
    if ($_FILES['image']['error'] == UPLOAD_ERR_OK) {
        $articleid = $_GET['id'];
        $imagename = getImageServerFromArticle($articleid);
        $dir = "../images/" . $imagename;
        unlink($dir);
        $title = $_POST['title'];
        $content = $_POST['content'];
        $temp_name = $_FILES['image']['tmp_name'];
        $newarticleid = newArticleId();
        $imagename = "article".$newarticleid.".".pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        $save_path = $upload_dir . $imagename;
        move_uploaded_file($temp_name, $save_path);
        $res = modifyArticle($imagename, $title, $content, $articleid);
        header("location: ../View/articles.php");
    }
}

if (isset($_POST['delete']) && $_POST['delete'] == "Supprimer l'article") {
    $articleid = $_GET['id'];
    $imagename = getImageServerFromArticle($articleid);
    $dir = "../images/" . $imagename;
    unlink($dir);
    deleteArticle($articleid);
    header("location: ../View/articles.php");
}

