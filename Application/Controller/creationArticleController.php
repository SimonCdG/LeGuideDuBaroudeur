<?php
session_start();

include('../Model/articlesModel.php');

if (!isset($_SESSION['user'])) {
    header("Location: ../View/index.php");
    exit();
}

include('../View/creationarticle.html');

$upload_dir=getcwd().DIRECTORY_SEPARATOR.'../images/';

if (isset($_POST['save']) && $_POST['save']=="Créer l'article") {
    if ($_FILES['image']['error'] == UPLOAD_ERR_OK) {
        $title = $_POST['title'];
        $content = $_POST['content'];
        $temp_name = $_FILES['image']['tmp_name'];
        $newarticleid = newArticleId() + 1;
        $imagename = "article".$newarticleid.".".pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        $save_path = $upload_dir.$imagename;
        move_uploaded_file($temp_name,$save_path);
        $res = newArticle($imagename, $title, $content, $_SESSION['userid']);
        header("location: ../View/articles.php");
    }
}