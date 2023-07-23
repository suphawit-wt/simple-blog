<?php
session_start();

if (!isset($_SESSION['loggedin'])) {
    header("location: /login.php");
}

require_once('../db/connect.php');

// Query Data
$limit = isset($_GET['limit']) ? $_GET['limit'] : 10;
$author_id = $_SESSION['author_id'];

$sql = "SELECT * FROM articles WHERE authors_id = ? ORDER BY updatetime DESC LIMIT 0, ?";
$stmt = $dbconn->prepare($sql);
$stmt->bind_param("ss", $author_id, $limit);
$stmt->execute();
$result = $stmt->get_result();

$articles_list = $result->fetch_all(MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="en" class="no-js">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link rel="shortcut icon" href="/assets/img/fav.png" />
    <meta charset="utf-8" />
    <title>BabyBlog</title>

    <link rel="stylesheet" href="/assets/css/font-awesome.min.css" />
    <link rel="stylesheet" href="/assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="/assets/css/themify-icons.css" />
    <link rel="stylesheet" href="/assets/css/main.css" />
    <link rel="stylesheet" href="/assets/css/custom.css" />
</head>

<body>
    <?php require_once "../components/header.php"; ?>

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
                        <?php foreach ($articles_list as $article) : ?>
                            <div class="table-row">
                                <div class="serial"><?php echo $article['id'] ?></div>
                                <div class="visit"><?php echo $article['title'] ?></div>
                                <div class="visit"><?php echo $article['create_ts'] ?></div>
                                <div class="visit"><?php echo $article['updatetime'] ?></div>
                                <div class="visit">
                                    <h4>
                                        <?php if ($article['publish_sts'] === 'Y') : ?>
                                            <span class="badge badge-pill badge-info">เผยแพร่แล้ว</span>
                                        <?php elseif ($article['publish_sts'] === 'N') : ?>
                                            <span class="badge badge-pill badge-light">ฉบับร่าง</span>
                                        <?php endif; ?>
                                    </h4>
                                </div>
                                <div class="visit">
                                    <a href="edit.php?id=<?php echo $article['id'] ?>" class="btn btn-sm btn-warning">แก้ไข</a>
                                    &nbsp;&nbsp;
                                    <a onclick="return confirm('คุณต้องการลบข้อมูลนี้ใช่หรือไม่?')" href="/articles/delete.php?id=<?php echo $article['id'] ?>" class="btn btn-sm btn-danger">ลบ</a>
                                    &nbsp;&nbsp;
                                    <form method="post" action="/articles/update_publish.php">
                                        <button type="submit" class="btn btn-sm btn-info" <?php echo (($article['publish_sts'] === 'Y') ? "disabled" : "") ?>>
                                            เผยแพร่
                                        </button>
                                        <button type="submit" class="btn btn-sm btn-light" <?php echo (($article['publish_sts'] === 'N') ? "disabled" : "") ?>>
                                            ฉบับร่าง
                                        </button>
                                        <input type="hidden" name="publishSts" value='<?php echo (($article['publish_sts'] === 'Y') ? "N" : "Y") ?>' />
                                        <input type="hidden" name="article_id" value='<?php echo $article['id'] ?>' />
                                    </form>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================ End Content Area =================-->

    <?php require_once "../components/footer.php"; ?>
</body>

</html>