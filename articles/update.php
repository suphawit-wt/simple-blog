<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    session_start();
    require_once('../db/connect.php');

    $author_id = $_SESSION['author_id'];
    $article_id = $_POST['id'];

    $title = $_POST['title'];
    $body = $_POST['body'];
    $datetime_now = date('Y-m-d H:i:s');
    $publish_sts = $_POST['publishSts'];

    $sql = "SELECT authors_id FROM articles WHERE id = ?";
    $stmt = $dbconn->prepare($sql);
    $stmt->bind_param("s", $article_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $article = $result->fetch_assoc();

    if ($article['authors_id'] === $author_id) {
        $sql = "UPDATE articles
                SET title = ?, body = ?, updatetime = ? , publish_sts = ?
                WHERE id = ?";
        $stmt = $dbconn->prepare($sql);
        $stmt->bind_param("sssss", $title, $body, $datetime_now, $publish_sts, $article_id);
        $stmt->execute();

        header("location: /articles/myarticle.php");
    } else {
        echo "<script type='text/javascript'>alert('*Forbidden, You doesn't have permission.');history.go(-1);</script>";
    }
} else {
    header("location: /");
}
