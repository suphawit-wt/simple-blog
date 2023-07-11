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
            WHERE username = '$username' AND passwd = '$passwd'";
    $result = $dbconn->query($sql);
    $obj = $result->fetch_object();

    if ($result->num_rows > 0) {
        $_SESSION['errMsg'] = "";
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $username;
        $_SESSION['name'] = $obj->name;
        $_SESSION['auid'] = $obj->id;
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
    <link rel="shortcut icon" href="./assets/img/fav.png" />
    <meta charset="UTF-8" />
    <title>BabyBlog</title>

    <link rel="stylesheet" href="./assets/css/linearicons.css" />
    <link rel="stylesheet" href="./assets/css/font-awesome.min.css" />
    <link rel="stylesheet" href="./assets/css/magnific-popup.css" />
    <link rel="stylesheet" href="./assets/css/nice-select.css" />
    <link rel="stylesheet" href="./assets/css/owl.carousel.css" />
    <link rel="stylesheet" href="./assets/css/bootstrap.css" />
    <link rel="stylesheet" href="./assets/css/bootstrap-datepicker.css" />
    <link rel="stylesheet" href="./assets/css/themify-icons.css" />
    <link rel="stylesheet" href="./assets/css/main.css" />
    <link rel="stylesheet" href="./assets/css/custom.css" />
</head>

<body>
    <?php
    include "./components/header.php";
    echo headerComponent();
    ?>

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
                            <a href="register.php" class="btn btn-link">ลงทะเบียนผู้แต่ง</a>
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

    <?php
    include "./components/footer.php";
    echo footerComponent();
    ?>

    <script src="./assets/js/vendor/jquery-2.2.4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous">
    </script>
    <script src="./assets/js/vendor/bootstrap.min.js"></script>
    <script src="./assets/js/owl.carousel.min.js"></script>
    <script src="./assets/js/jquery.sticky.js"></script>
    <script src="./assets/js/jquery.tabs.min.js"></script>
    <script src="./assets/js/parallax.min.js"></script>
    <script src="./assets/js/jquery.nice-select.min.js"></script>
    <script src="./assets/js/jquery.ajaxchimp.min.js"></script>
    <script src="./assets/js/jquery.magnific-popup.min.js"></script>
    <script src="./assets/js/bootstrap-datepicker.js"></script>
    <script src="./assets/js/main.js"></script>
</body>

</html>