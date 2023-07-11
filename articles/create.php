<?php
session_start();
require_once('../db/connect.php');

if (!isset($_SESSION['loggedin'])) {
    header("location: /login.php");
}

$title = $_POST['title'];
$body = $_POST['body'];
$tn = date('Y-m-d H:i:s');
$auid = $_SESSION['auid'];

$sql = "INSERT INTO articles (title, body, create_ts, authors_id)
        VALUES (?, ?, ?, ?)";
$stmt = $dbconn->prepare($sql);
$stmt->bind_param("ssss", $title, $body, $tn, $auid);
$stmt->execute();

header("location: /articles/myarticle.php");
