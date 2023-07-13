<?php
session_start();
require_once('../db/connect.php');

if (!isset($_SESSION['loggedin'])) {
    header("location: /login.php");
}

// Query Data
$author_id = $_SESSION['author_id'];

$sql = "SELECT * FROM authors WHERE id = ?";
$stmt = $dbconn->prepare($sql);
$stmt->bind_param("s", $author_id);
$stmt->execute();
$result = $stmt->get_result();

$author = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="th" class="no-js">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link rel="shortcut icon" href="/assets/img/fav.png" />
    <meta charset="utf-8" />
    <title>BabyBlog</title>

    <link rel="stylesheet" href="/assets/css/linearicons.css" />
    <link rel="stylesheet" href="/assets/css/font-awesome.min.css" />
    <link rel="stylesheet" href="/assets/css/magnific-popup.css" />
    <link rel="stylesheet" href="/assets/css/nice-select.css" />
    <link rel="stylesheet" href="/assets/css/owl.carousel.css" />
    <link rel="stylesheet" href="/assets/css/bootstrap.css" />
    <link rel="stylesheet" href="/assets/css/bootstrap-datepicker.css" />
    <link rel="stylesheet" href="/assets/css/themify-icons.css" />
    <link rel="stylesheet" href="/assets/css/main.css" />
    <link rel="stylesheet" href="/assets/css/custom.css" />
    <script src="/assets/js/validation.js"></script>
</head>

<body>
    <?php require_once "../components/header.php"; ?>

    <!--================ Start Content Area =================-->
    <section class="container mt-20 mb-20">
        <form method="post" action="/authors/update.php">
            <div class="row">
                <div class="col-12">
                    <h3 class="mb-10">แก้ไขข้อมูลของฉัน</h3>
                </div>
                <div class="col-12">
                    <div class="col-6">
                        <div class="form-group">
                            <label class="col-md-4 col-form-label">Username</label>
                            <div class="col-md-12">
                                <input value="<?php echo $author['username'] ?>" type="text" class="form-control" id="username" name="username" maxlength="45">
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label class="col-md-4 col-form-label">Password</label>
                            <div class="col-md-12">
                                <input type="password" class="form-control" id="password" name="password" maxlength="45">
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label class="col-md-4 col-form-label">Confirm Password</label>
                            <div class="col-md-12">
                                <input type="password" class="form-control" id="conpasswd" name="conpasswd" maxlength="45">
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label class="col-md-4 col-form-label">Name</label>
                            <div class="col-md-12">
                                <input value="<?php echo $author['name'] ?>" type="text" class="form-control" id="name" name="name" maxlength="45">
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label class="col-md-4 col-form-label">Penname</label>
                            <div class="col-md-12">
                                <input value="<?php echo $author['penname'] ?>" type="text" class="form-control" id="penname" name="penname" maxlength="45">
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label class="col-md-4 col-form-label">Email</label>
                            <div class="col-md-12">
                                <input value="<?php echo $author['email'] ?>" type="email" class="form-control" id="email" name="email" maxlength="45">
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="col-12 ">
                            <button type="submit" class="btn btn-warning">อัพเดท</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </section>
    <!--================ End Content Area =================-->

    <?php require_once "../components/footer.php"; ?>

    <script src="/assets/js/vendor/jquery-2.2.4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous">
    </script>
    <script src="/assets/js/vendor/bootstrap.min.js"></script>
    <script src="/assets/js/owl.carousel.min.js"></script>
    <script src="/assets/js/jquery.sticky.js"></script>
    <script src="/assets/js/jquery.tabs.min.js"></script>
    <script src="/assets/js/parallax.min.js"></script>
    <script src="/assets/js/jquery.nice-select.min.js"></script>
    <script src="/assets/js/jquery.ajaxchimp.min.js"></script>
    <script src="/assets/js/jquery.magnific-popup.min.js"></script>
    <script src="/assets/js/bootstrap-datepicker.js"></script>
    <script src="/assets/js/main.js"></script>
</body>

</html>