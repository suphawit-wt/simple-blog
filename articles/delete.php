<?php
session_start();
require_once('../db/connect.php');

if (!isset($_SESSION['loggedin'])) {
    header("location: /login.php");
}

$article_id = $_GET["id"];

$sql = "DELETE FROM articles WHERE id = ?";
$stmt = $dbconn->prepare($sql);
$stmt->bind_param("s", $article_id);
$stmt->execute();

header("location: /articles/myarticle.php");
