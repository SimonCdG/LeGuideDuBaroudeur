<?php

$conn = new PDO('pgsql:host=localhost;dbname=postgres', 'postgres', '1308');

function newArticle($imagename, $title, $content, $author)
{
    global $conn;
    try {
        $request = $conn->prepare("insert into articles values (DEFAULT, :title, :imagename, :content, :author)");
        return $request->execute(array('title' => $title, 'imagename' => $imagename, 'content' => $content, 'author' => $author));
    } catch (PDOException $e) {
        die('ERROR: ' . $e->getMessage() . "\n");
    }
}

function modifyArticle($imagename, $title, $content, $articleid)
{
    global $conn;
    try {
        $request = $conn->prepare("update articles set title = :title, imagename = :imagename, content = :content where articleid = :articleid");
        return $request->execute(array('title' => $title, 'imagename' => $imagename, 'content' => $content, 'articleid' => $articleid));
    } catch (PDOException $e) {
        die('ERROR: ' . $e->getMessage() . "\n");
    }
}

function deleteArticle($articleid)
{
    global $conn;
    try {
        $request = $conn->prepare("delete from articles where articleid = :articleid");
        return $request->execute(array('articleid' => $articleid));
    } catch (PDOException $e) {
        die('ERROR: ' . $e->getMessage() . "\n");
    }
}

function showArticles()
{
    global $conn;
    try {
        $request = $conn->prepare("select * from articles");
        $request->execute();
        return $request->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        die('ERROR: ' . $e->getMessage() . "\n");
    }
}

function getImageServerFromArticle($articleid)
{
    global $conn;
    try {
        $request = $conn->prepare("select imagename from articles where articleid = :articleid");
        $request->execute(array('articleid' => $articleid));
        $res = $request->fetch();
        return $res[0];
    } catch (PDOException $e) {
        die('ERROR: ' . $e->getMessage() . "\n");
    }
}

function verifyArticleOwner($userid, $articleid)
{
    global $conn;
    try {
        $request = $conn->prepare("select articleid, case when count(articleid)>0 then true end from articles where articleid = :articleid and author = :userid group by articleid");
        $request->execute(array('articleid' => $articleid, 'userid' => $userid));
        return $request->fetch();
    } catch (PDOException $e) {
        die('ERROR: ' . $e->getMessage() . "\n");
    }
}

function articleAuthor($articleid) {
    global $conn;
    try {
        $request = $conn->prepare("select author from articles where articleid = :articleid LIMIT 1");
        $request->execute(array('articleid' => $articleid));
        $res = $request->fetch();
        return $res[0];
    } catch (PDOException $e) {
        die('ERROR: ' . $e->getMessage() . "\n");
    }
}

function newArticleId() {
    global $conn;
    try {
        $request = $conn->prepare("select articleid from articles ORDER BY articleid DESC LIMIT 1");
        $request->execute();
        $res = $request->fetch();
        return $res[0];
    } catch (PDOException $e) {
        die('ERROR: ' . $e->getMessage() . "\n");
    }
}