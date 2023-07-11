<?php
session_start();
require_once('../db/connect.php');

if (!isset($_SESSION['loggedin'])) {
    header("location: /login.php");
}

$auid = $_SESSION['auid'];
$username = $_POST['username'];
$name = $_POST['name'];
$email = $_POST['email'];
$passwd = md5($_POST['password']);
$penname = $_POST['penname'];

$sql = "UPDATE authors
        SET username = ?, passwd = ?, name = ?, penname = ?, email = ?
        WHERE id = ?";
$stmt = $dbconn->prepare($sql);
$stmt->bind_param("ssssss", $username, $passwd, $name, $penname, $email, $auid);
$stmt->execute();

$_SESSION['username'] = $username;

header("location: /articles/myarticle.php");
