<?php
session_start();
require_once('../db/connect.php');

if (!isset($_SESSION['loggedin'])) {
    header("location: /login.php");
}

// Query Data
$article_id = $_GET['id'];
$author_id = $_SESSION['author_id'];

$sql = "SELECT * FROM articles WHERE id = ? AND authors_id = ?";
$stmt = $dbconn->prepare($sql);
$stmt->bind_param("ss", $article_id, $author_id);
$stmt->execute();
$result = $stmt->get_result();

$article = $result->fetch_assoc();

if (empty($article)) {
    echo "<script type='text/javascript'>alert('*ไม่สามารถเรียกดูบทความนี้ได้ เนื่องจากคุณไม่ใช่เจ้าของ');history.go(-1);</script>";
}
?>
<!DOCTYPE html>
<html lang="th" class="no-js">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link rel="shortcut icon" href="../assets/img/fav.png" />
    <meta charset="UTF-8" />
    <title>BabyBlog</title>

    <link rel="stylesheet" href="../assets/css/linearicons.css" />
    <link rel="stylesheet" href="../assets/css/font-awesome.min.css" />
    <link rel="stylesheet" href="../assets/css/magnific-popup.css" />
    <link rel="stylesheet" href="../assets/css/owl.carousel.css" />
    <link rel="stylesheet" href="../assets/css/bootstrap.css" />
    <link rel="stylesheet" href="../assets/css/bootstrap-datepicker.css" />
    <link rel="stylesheet" href="../assets/css/themify-icons.css" />
    <link rel="stylesheet" href="../assets/css/main.css" />
    <link rel="stylesheet" href="../assets/css/custom.css" />
</head>

<body>
    <?php
    include "../components/header.php";
    echo HeaderComponent();
    ?>

    <!--================ Start Content Area =================-->
    <section class="container mt-20 mb-20">
        <form method="post" action="/articles/update.php">
            <div class="row">
                <div class="col-12">
                    <h3 class="mb-10">แก้ไขบทความ <a href="/articles/myarticle.php" class="btn btn-sm btn-primary">ไปยังหน้า: บทความของฉัน</a></h3>
                </div>
                <div class="col-12">
                    <div class="col-6">
                        <div class="form-group">
                            <label class="col-md-4 col-form-label">ID</label>
                            <div class="col-md-12">
                                <input type="text" class="form-control" value="<?php echo $article['id'] ?>" disabled>
                                <input type="hidden" name="id" value="<?php echo $article['id'] ?>">
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label class="col-md-4 col-form-label">หัวข้อ</label>
                            <div class="col-md-12">
                                <input type="text" class="form-control" name="title" value="<?php echo $article['title'] ?>">
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label class="col-md-4 col-form-label">เนื้อหา</label>
                            <div class="col-md-12">
                                <textarea type="text" class="form-control" name="body"><?php echo $article['body'] ?></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label class="col-md-4 col-form-label">สถานะ</label>
                            <div class="col-md-12">
                                <select name="publishSts" class="custom-select">
                                    <option value='Y' <?php if ($article['publish_sts'] == 'Y') {
                                                            echo "selected";
                                                        } ?>>
                                        เผยแพร่แล้ว
                                    </option>
                                    <option value='N' <?php if ($article['publish_sts'] == 'N') {
                                                            echo "selected";
                                                        } ?>>
                                        ฉบับร่าง
                                    </option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-warning">
                                    อัพเดท
                                </button>
                                &nbsp;&nbsp;
                                <a onclick="return confirm('คุณต้องการลบข้อมูลนี้ใช่หรือไม่?')" href="/articles/delete.php?id=<?php echo $article['id'] ?>" class="btn btn-sm btn-danger">
                                    ลบ
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </section>
    <!--================ End Content Area =================-->

    <?php
    include "../components/footer.php";
    echo FooterComponent();
    ?>

    <script src="../assets/js/vendor/jquery-2.2.4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="../assets/js/vendor/bootstrap.min.js"></script>
    <script src="../assets/js/owl.carousel.min.js"></script>
    <script src="../assets/js/jquery.sticky.js"></script>
    <script src="../assets/js/jquery.tabs.min.js"></script>
    <script src="../assets/js/parallax.min.js"></script>
    <script src="../assets/js/jquery.ajaxchimp.min.js"></script>
    <script src="../assets/js/jquery.magnific-popup.min.js"></script>
    <script src="../assets/js/bootstrap-datepicker.js"></script>
    <script src="../assets/js/main.js"></script>
</body>

</html>