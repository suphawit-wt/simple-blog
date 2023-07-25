<?php
session_start();

if (!isset($_SESSION['loggedin'])) {
    header("location: /login.php");
}

require_once('../db/connect.php');

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
    echo "<script type='text/javascript'>alert('*Forbidden, You doesn't have permission.');history.go(-1);</script>";
}
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
        <form method="post" action="/articles/update.php">
            <div class="row">
                <div class="col-12">
                    <h3 class="mb-10">Edit article <a href="/articles/myarticle.php" class="btn btn-sm btn-primary">Back to: My Article</a></h3>
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
                            <label class="col-md-4 col-form-label">Title</label>
                            <div class="col-md-12">
                                <input type="text" class="form-control" name="title" value="<?php echo $article['title'] ?>">
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label class="col-md-4 col-form-label">Content</label>
                            <div class="col-md-12">
                                <textarea type="text" class="form-control" name="body"><?php echo $article['body'] ?></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label class="col-md-4 col-form-label">Status</label>
                            <div class="col-md-12">
                                <select name="publishSts" class="custom-select">
                                    <option value='Y' <?php echo (($article['publish_sts'] === 'Y') ? "selected" : "") ?>>
                                        Publish
                                    </option>
                                    <option value='N' <?php echo (($article['publish_sts'] === 'N') ? "selected" : "") ?>>
                                        Draft
                                    </option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-warning">
                                    Update
                                </button>
                                &nbsp;&nbsp;
                                <a onclick="return confirm('Do you want to delete this article?')" href="/articles/delete.php?id=<?php echo $article['id'] ?>" class="btn btn-sm btn-danger">
                                    Delete
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </section>
    <!--================ End Content Area =================-->

    <?php require_once "../components/footer.php"; ?>
</body>

</html>