<?php
require_once('../db/connect.php');

$username = $_POST['username'];
$name = $_POST['name'];
$email = $_POST['email'];
$passwd = md5($_POST['password']);
$penname = $_POST['penname'];

$chkusern = "SELECT authors.username FROM `authors` WHERE username = '$username'";
$resultU = $dbconn->query($chkusern);
$rowcount = mysqli_num_rows($resultU);

if ($rowcount <= 0) {
    $sql = "INSERT INTO authors (username, passwd, name, penname, email) 
            VALUES (?,?,?,?,?)";
    $stmt = $dbconn->prepare($sql);
    $stmt->bind_param("sssss", $username, $passwd, $name, $penname, $email);
    $stmt->execute();
    header("location: /login.php");
} else {
    echo "<script type='text/javascript'>alert('Username $username ได้ถูกใช้แล้ว');history.go(-1);</script>";
}
