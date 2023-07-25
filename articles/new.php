<?php
session_start();

if (!isset($_SESSION['loggedin'])) {
    header("location: /login.php");
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
    <script src="/assets/js/validation.js"></script>
</head>

<body>
    <?php require_once "../components/header.php"; ?>

    <!--================ Start Content Area =================-->
    <section class="container mt-20 mb-20">
        <form method="post" action="/articles/create.php" name="article_form" onSubmit="return newArtiValidation();">
            <div class="row">
                <div class="col-12">
                    <h3 class="mb-10">Create new article <a href="/articles/myarticle.php" class="btn btn-sm btn-primary">Back to: My Article</a></h3>
                </div>
                <div class="col-12">
                    <div class="col-6">
                        <div class="form-group">
                            <label class="col-md-4 col-form-label">Title</label>
                            <div class="col-md-12">
                                <input type="text" class="form-control" name="title">
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label class="col-md-4 col-form-label">Content</label>
                            <div class="col-md-12">
                                <textarea type="text" class="form-control" name="body"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="col-12 ">
                            <button type="submit" class="btn btn-primary">Create</button>
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

    <?php require_once "../components/footer.php"; ?>
</body>

</html>