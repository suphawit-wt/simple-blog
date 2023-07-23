<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once('../db/connect.php');

    $username = $_POST['username'];
    $passwd = md5($_POST['password']);
    $name = $_POST['name'];
    $penname = $_POST['penname'];
    $email = $_POST['email'];

    $sql = "SELECT username FROM authors WHERE username = ?";
    $stmt = $dbconn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    $author = $result->fetch_assoc();

    if (empty($author)) {
        $sql = "INSERT INTO authors (username, passwd, name, penname, email)
                VALUES (?,?,?,?,?)";
        $stmt = $dbconn->prepare($sql);
        $stmt->bind_param("sssss", $username, $passwd, $name, $penname, $email);
        $stmt->execute();
        header("location: /login.php");
    } else {
        echo "<script type='text/javascript'>alert('*Username $username already in use!');history.go(-1);</script>";
    }
} else {
    header("location: /");
}
