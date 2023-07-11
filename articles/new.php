<?php
session_start();

if (!isset($_SESSION['loggedin'])) {
    header("location: /login.php");
}
?>
<!DOCTYPE html>
<html lang="th" class="no-js">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link rel="shortcut icon" href="./assets/img/fav.png" />
    <meta charset="UTF-8" />
    <title>BabyBlog</title>

    <link rel="stylesheet" href="../assets/css/linearicons.css" />
    <link rel="stylesheet" href="../assets/css/font-awesome.min.css" />
    <link rel="stylesheet" href="../assets/css/magnific-popup.css" />
    <link rel="stylesheet" href="../assets/css/nice-select.css" />
    <link rel="stylesheet" href="../assets/css/owl.carousel.css" />
    <link rel="stylesheet" href="../assets/css/bootstrap.css" />
    <link rel="stylesheet" href="../assets/css/bootstrap-datepicker.css" />
    <link rel="stylesheet" href="../assets/css/themify-icons.css" />
    <link rel="stylesheet" href="../assets/css/main.css" />
    <link rel="stylesheet" href="../assets/css/custom.css" />
    <script src="../assets/js/validation.js"></script>
</head>

<body>
    <?php
    include "../components/header.php";
    echo headerComponent();
    ?>

    <!--================ Start Content Area =================-->
    <section class="container mt-20 mb-20">
        <form method="post" action="/articles/create.php" name="newarti" onSubmit="return newArtiValidation();">
            <div class="row">
                <div class="col-12">
                    <h3 class="mb-10">เพิ่มบทความใหม่ <a href="/articles/myarticle.php" class="btn btn-sm btn-primary">ไปยังหน้า: บทความของฉัน</a></h3>
                </div>
                <div class="col-12">
                    <div class="col-6">
                        <div class="form-group">
                            <label class="col-md-4 col-form-label">หัวข้อ</label>
                            <div class="col-md-12">
                                <input type="text" class="form-control" name="title">
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label class="col-md-4 col-form-label">เนื้อหา</label>
                            <div class="col-md-12">
                                <textarea type="text" class="form-control" name="body"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="col-12 ">
                            <button type="submit" class="btn btn-primary">เพิ่มบทความใหม่</button>
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
    include "../components/footer.php";
    echo footerComponent();
    ?>

    <script src="../assets/js/vendor/jquery-2.2.4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous">
    </script>
    <script src="../assets/js/vendor/bootstrap.min.js"></script>
    <script src="../assets/js/owl.carousel.min.js"></script>
    <script src="../assets/js/jquery.sticky.js"></script>
    <script src="../assets/js/jquery.tabs.min.js"></script>
    <script src="../assets/js/parallax.min.js"></script>
    <script src="../assets/js/jquery.nice-select.min.js"></script>
    <script src="../assets/js/jquery.ajaxchimp.min.js"></script>
    <script src="../assets/js/jquery.magnific-popup.min.js"></script>
    <script src="../assets/js/bootstrap-datepicker.js"></script>
    <script src="../assets/js/main.js"></script>
</body>

</html>