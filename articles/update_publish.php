<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    session_start();
    require_once('../db/connect.php');

    $author_id = $_SESSION['author_id'];
    $article_id = $_POST['article_id'];
    $publish_sts = $_POST['publishSts'];
    $datetime_now = date('Y-m-d H:i:s');

    $sql = "SELECT authors_id FROM articles WHERE id = ?";
    $stmt = $dbconn->prepare($sql);
    $stmt->bind_param("s", $article_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $article = $result->fetch_assoc();

    if ($article['authors_id'] === $author_id) {
        $sql = "UPDATE articles
                SET publish_sts = ?, updatetime = ?
                WHERE id = ?";
        $stmt = $dbconn->prepare($sql);
        $stmt->bind_param("sss", $publish_sts, $datetime_now, $article_id);
        $stmt->execute();

        header("location: /articles/myarticle.php");
    } else {
        echo "<script type='text/javascript'>alert('*Forbidden, You doesn't have permission.');history.go(-1);</script>";
    }
} else {
    header("location: /");
}
