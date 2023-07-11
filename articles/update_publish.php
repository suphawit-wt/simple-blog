<?php
session_start();
require_once('../db/connect.php');

if (!isset($_SESSION['loggedin'])) {
    header("location: /login.php");
}

$arID = $_GET['id'];
$pbsts = $_POST['publishSts'];
$upDT = date('Y-m-d H:i:s');
$sesU = $_SESSION['username'];

$chksql = "SELECT authors.id FROM authors WHERE username = '$sesU'";
$chksql2 = "SELECT articles.authors_id FROM articles WHERE id = $arID";
$resultS1 = $dbconn->query($chksql);
$resultS2 = $dbconn->query($chksql2);
$row1 = $resultS1->fetch_object();
$row2 = $resultS2->fetch_object();

if ($row1->id == $row2->authors_id) {
    $sql = "UPDATE articles
            SET publish_sts = ?, updatetime = ?
            WHERE id = ?";
    $stmt = $dbconn->prepare($sql);
    $stmt->bind_param("sss", $pbsts, $upDT, $arID);
    $stmt->execute();

    header("location: /articles/myarticle.php");
} else {
    echo "<script type='text/javascript'>alert('แก้ไขได้เฉพาะบทความของตนเองเท่านั้น!');history.go(-1);</script>";
}
