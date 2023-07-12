<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    session_start();
    require_once('../db/connect.php');

    $title = $_POST['title'];
    $body = $_POST['body'];
    $datetime_now = date('Y-m-d H:i:s');
    $author_id = $_SESSION['author_id'];

    $sql = "INSERT INTO articles (title, body, create_ts, authors_id)
            VALUES (?, ?, ?, ?)";
    $stmt = $dbconn->prepare($sql);
    $stmt->bind_param("ssss", $title, $body, $datetime_now, $author_id);
    $stmt->execute();

    header("location: /articles/myarticle.php");
} else {
    header("location: /");
}
