<?php
session_start();
require_once('../db/connect.php');

if (!isset($_SESSION['loggedin'])) {
    header("location: /login.php");
}

// Query Data
$limit = isset($_GET['limit']) ? $_GET['limit'] : 10;
$auid = $_SESSION['auid'];
$sql = "SELECT *
        FROM articles 
        WHERE articles.authors_id = $auid
        ORDER BY updatetime DESC";
$result = $dbconn->query($sql);

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
    <link rel="stylesheet" href="../assets/css/nice-select.css" />
    <link rel="stylesheet" href="../assets/css/owl.carousel.css" />
    <link rel="stylesheet" href="../assets/css/bootstrap.css" />
    <link rel="stylesheet" href="../assets/css/bootstrap-datepicker.css" />
    <link rel="stylesheet" href="../assets/css/themify-icons.css" />
    <link rel="stylesheet" href="../assets/css/main.css" />
    <link rel="stylesheet" href="../assets/css/bootstrap-toggle.min.css">
    <script src="../assets/js/bootstrap-toggle.min.js"></script>
    <link rel="stylesheet" href="../assets/css/custom.css" />
</head>

<body>
    <?php
    include "../components/header.php";
    echo headerComponent();
    ?>

    <!--================ Start Content Area =================-->
    <section class="container mt-20 mb-20">
        <div class="row">
            <div class="col-12">
                <h3 class="mb-10">บทความของฉัน <a href="/articles/new.php" class="btn btn-sm btn-primary">เพิ่มบทความใหม่</a></h3>
            </div>
            <div class="col-12">
                <div class="progress-table-wrap">
                    <div class="progress-table">
                        <div class="table-head">
                            <div class="serial">id</div>
                            <div class="visit">ชื่อบทความ</div>
                            <div class="visit">เวลาที่สร้าง</div>
                            <div class="visit">แก้ไขล่าสุดเมื่อ</div>
                            <div class="visit">สถานะ</div>
                            <div class="visit">การดำเนินการ</div>
                        </div>
                        <?php
                        if (!$result) {
                            echo ("Error: " . $dbconn->error);
                        } else {
                            while ($row = $result->fetch_object()) { ?>
                                <div class="table-row">
                                    <div class="serial"><?php echo $row->id ?></div>
                                    <div class="visit"><?php echo $row->title ?></div>
                                    <div class="visit"><?php echo $row->create_ts ?></div>
                                    <div class="visit"><?php echo $row->updatetime ?></div>
                                    <div class="visit">
                                        <h4>
                                            <?php if ($row->publish_sts == 'Y') { ?>
                                                <span class="badge badge-pill badge-info">เผยแพร่แล้ว</span>
                                            <?php } else if ($row->publish_sts == 'N') { ?>
                                                <span class="badge badge-pill badge-light">ฉบับร่าง</span>
                                            <?php } ?>
                                        </h4>
                                    </div>
                                    <div class="visit">
                                        <a href="edit.php?id=<?php echo $row->id ?>" class="btn btn-sm btn-warning">แก้ไข</a>
                                        &nbsp;&nbsp;
                                        <a onclick="return confirm('คุณต้องการลบข้อมูลนี้ใช่หรือไม่?')" href="/articles/delete.php?id=<?php echo $row->id ?>" class="btn btn-sm btn-danger">ลบ</a>
                                        &nbsp;&nbsp;
                                        <form method="post" action="/articles/update_publish.php?id=<?php echo $row->id ?>">
                                            <button type="submit" class="btn btn-sm btn-info" <?php if ($row->publish_sts == 'Y') {
                                                                                                    echo "disabled";
                                                                                                } ?>>
                                                เผยแพร่
                                            </button>
                                            <button type="submit" class="btn btn-sm btn-light" <?php if ($row->publish_sts == 'N') {
                                                                                                    echo "disabled";
                                                                                                } ?>>
                                                ฉบับร่าง
                                            </button>
                                            <input type="hidden" name="publishSts" value='<?php if ($row->publish_sts == 'Y') {
                                                                                                echo "N";
                                                                                            } else {
                                                                                                echo "Y";
                                                                                            } ?>'>
                                        </form>
                                    </div>
                                </div>
                        <?php
                            }
                        } ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================ End Content Area =================-->

    <?php
    include "../components/footer.php";
    echo footerComponent();
    ?>

    <script src="../assets/js/vendor/jquery-2.2.4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
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