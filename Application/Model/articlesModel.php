<?php

$conn = new PDO('pgsql:host=localhost;dbname=postgres', 'postgres', '1308');

function newArticle($imagename, $title, $content, $author)
{
    global $conn;
    try {
        $encode = json_encode($imagename);
        $encode = str_replace('[', '{', $encode);
        $encode = str_replace(']', '}', $encode);
        $encode = str_replace('', '', $encode);
        $encode = str_replace('"', '', $encode);

        $request = $conn->prepare("insert into articles values (DEFAULT, :title, :imagename, :content, :author)");

        $request->bindParam(':title', $title, PDO::PARAM_STR);
        $request->bindParam(':imagename', $encode, PDO::PARAM_STR);
        $request->bindParam(':content', $content, PDO::PARAM_STR);
        $request->bindParam(':author', $author, PDO::PARAM_INT);

        return $request->execute();
    } catch (PDOException $e) {
        die('ERROR: ' . $e->getMessage() . "\n");
    }
}

function encode_array($array)
{
    $encoded = json_encode($array);
    $encoded = str_replace('[', '{', $encoded);
    return str_replace(']', '}', $encoded);
}


function modifyArticle($imagename, $title, $content, $articleid)
{
    global $conn;
    try {
        $encode = json_encode($imagename);
        $encode = str_replace('[', '{', $encode);
        $encode = str_replace(']', '}', $encode);
        $encode = str_replace('', '', $encode);
        $encode = str_replace('"', '', $encode);

        $request = $conn->prepare("UPDATE articles SET title = :title, imagesname = :imagename, content = :content WHERE articleid = :articleid");

        $request->bindParam(':title', $title, PDO::PARAM_STR);
        $request->bindParam(':imagename', $encode, PDO::PARAM_STR);
        $request->bindParam(':content', $content, PDO::PARAM_STR);
        $request->bindParam(':articleid', $articleid, PDO::PARAM_INT);

        return $request->execute();
    } catch (PDOException $e) {
        die('ERROR: ' . $e->getMessage() . "\n");
    } catch (InvalidArgumentException $e) {
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
        $request = $conn->prepare("select articleid, title, imagesname, content, author, schoolname from articles join users on articles.author = users.userid");
        $request->execute();
        return $request->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        die('ERROR: ' . $e->getMessage() . "\n");
    }
}

function showArticle($articleid)
{
    global $conn;
    try {
        $request = $conn->prepare("select * from articles where articleid = :articleid");
        $request->execute(array('articleid' => $articleid));
        $result = $request->fetch(PDO::FETCH_ASSOC);
        if ($result) {
            if (isset($result['imagesname'])) {
                $result['imagesname'] = str_getcsv(trim($result['imagesname'], '{}'));
                return $result;
            }
        }
    } catch (PDOException $e) {
        die('ERROR: ' . $e->getMessage() . "\n");
    }
}

function getImagesServerFromArticle($articleid)
{
    global $conn;
    try {
        $request = $conn->prepare("select imagesname from articles where articleid = :articleid");
        $request->execute(array('articleid' => $articleid));
        $result = $request->fetch(PDO::FETCH_ASSOC);
        if ($result) {
            if (isset($result['imagesname'])) {
                $result['imagesname'] = str_getcsv(trim($result['imagesname'], '{}'));
                return $result;
            }
        }
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

function getArticleForCarrousel()
{
    global $conn;
    try {
        $request = $conn->prepare("select imagesname[1], title, schoolname from articles join users ON articles.author = users.userid");
        $request->execute();
        return $request->fetchAll();
    } catch (PDOException $e) {
        die('ERROR: ' . $e->getMessage() . "\n");
    }
}