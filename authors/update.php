<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    session_start();
    require_once('../db/connect.php');

    $username = $_POST['username'];
    $passwd = md5($_POST['password']);
    $name = $_POST['name'];
    $penname = $_POST['penname'];
    $email = $_POST['email'];
    $author_id = $_SESSION['author_id'];

    $sql = "SELECT id, username FROM authors WHERE username = ?";
    $stmt = $dbconn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    $author = $result->fetch_assoc();

    if (empty($author) || $author['id'] === $author_id) {
        $sql = "UPDATE authors
                SET username = ?, passwd = ?, name = ?, penname = ?, email = ?
                WHERE id = ?";
        $stmt = $dbconn->prepare($sql);
        $stmt->bind_param("ssssss", $username, $passwd, $name, $penname, $email, $author_id);
        $stmt->execute();

        $_SESSION['username'] = $username;

        header("location: /articles/myarticle.php");
    } else {
        echo "<script type='text/javascript'>alert('*Username $username ได้ถูกใช้แล้ว');history.go(-1);</script>";
    }
} else {
    header("location: /");
}
