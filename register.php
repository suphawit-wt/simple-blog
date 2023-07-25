<?php
session_start();

if (isset($_SESSION['loggedin'])) {
    header("location: /articles/myarticle.php");
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
    <link rel="stylesheet" href="/assets/css/main.css" />
    <link rel="stylesheet" href="/assets/css/custom.css" />
    <script src="/assets/js/validation.js"></script>
</head>

<body onload="document.author_form.userid.focus();">
    <?php require_once "./components/header.php"; ?>

    <!--================ Start Content Area =================-->
    <section class="container mt-20 mb-20">
        <form action="/authors/create.php" method="post" name="author_form" onSubmit="return formValidation();">
            <div class="row">
                <div class="col-12">
                    <h3 class="mb-10">Register</h3>
                </div>
                <div class="col-12">
                    <div class="col-6">
                        <div class="form-group">
                            <label class="col-md-4 col-form-label">Username</label>
                            <div class="col-md-12">
                                <input type="text" class="form-control" id="username" name="username" maxlength="45">
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
                                <input type="text" class="form-control" id="name" name="name" maxlength="45">
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label class="col-md-4 col-form-label">Penname</label>
                            <div class="col-md-12">
                                <input type="text" class="form-control" id="penname" name="penname" maxlength="45">
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label class="col-md-4 col-form-label">Email</label>
                            <div class="col-md-12">
                                <input type="email" class="form-control" id="email" name="email" maxlength="45">
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="col-12 ">
                            <button type="submit" class="btn btn-success">Register</button>
                            <a href="/login.php" class="btn btn-link">Back to Login page</a>
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