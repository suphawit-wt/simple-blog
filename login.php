<?php
session_start();
require_once('./db/connect.php');

if (isset($_SESSION['loggedin'])) {
    header("location: /articles/myarticle.php");
}

$_SESSION['errMsg'] = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $passwd =  md5($_POST['password']);

    $sql = "SELECT * FROM authors
            WHERE username = ?
            AND passwd = ?";
    $stmt = $dbconn->prepare($sql);
    $stmt->bind_param("ss", $username, $passwd);
    $stmt->execute();
    $result = $stmt->get_result();

    $author = $result->fetch_assoc();

    if (!empty($author)) {
        $_SESSION['errMsg'] = "";
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $author['username'];
        $_SESSION['author_id'] = $author['id'];
        header("location: /articles/myarticle.php");
        exit(0);
    } else {
        $_SESSION['errMsg'] = "*Username or Password Incorrect!";
    }
}
?>
<!DOCTYPE html>
<html lang="th" class="no-js">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link rel="shortcut icon" href="/assets/img/fav.png" />
    <meta charset="utf-8" />
    <title>BabyBlog</title>

    <link rel="stylesheet" href="/assets/css/font-awesome.min.css" />
    <link rel="stylesheet" href="/assets/css/bootstrap.css" />
    <link rel="stylesheet" href="/assets/css/main.css" />
    <link rel="stylesheet" href="/assets/css/custom.css" />
</head>

<body>
    <?php require_once "./components/header.php"; ?>

    <!--================ Start Content Area =================-->
    <section class="container mt-20 mb-20">
        <form method="post" action="/login.php">
            <div class="row">
                <div class="col-12">
                    <h3 class="mb-10">เข้าสู่ระบบ</h3>
                </div>
                <div class="col-12">
                    <div class="col-6">
                        <div class="form-group">
                            <label class="col-md-4 col-form-label">Username</label>
                            <div class="col-md-12">
                                <input type="text" class="form-control" name="username" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label class="col-md-4 col-form-label">Password</label>
                            <div class="col-md-12">
                                <input type="password" class="form-control" name="password" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="col-12 ">
                            <button type="submit" class="btn btn-primary">เข้าสู่ระบบ</button>
                            <a href="/register.php" class="btn btn-link">ลงทะเบียนผู้แต่ง</a>
                        </div>
                        <div class="col-12">
                            <p class="text-danger mt-2"><?php echo $_SESSION['errMsg']; ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </section>
    <!--================ End Content Area =================-->

    <?php require_once "./components/footer.php"; ?>
</body>

</html>