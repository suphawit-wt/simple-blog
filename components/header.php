<!--================ Start Header Area =================-->
<header class="header-area">
    <div class="container">
        <div class="header-wrap">
            <div class="header-top d-flex justify-content-between align-items-lg-center navbar-expand-lg">
                <div class="col-1 d-none d-lg-block">
                    <a class="nav-link-text" href="/">Home</a>
                </div>
                <div class="col-5 text-lg-center mt-2 mt-lg-0">
                    <span class="logo-outer">
                        <span class="logo-inner">
                            <a href="/"><img class="mx-auto" src="/assets/img/logo.png" alt="logo" /></a>
                        </span>
                    </span>
                </div>
                <nav class="col navbar navbar-expand-lg justify-content-end">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
                        <span class="lnr lnr-menu"></span>
                    </button>
                    <div class="collapse navbar-collapse menu-right" id="collapsibleNavbar">
                        <ul class="navbar-nav justify-content-center">
                            <li class="nav-item hide-lg">
                                <a class="nav-link-text" href="/">Home</a>
                            </li>
                            <?php if (isset($_SESSION['loggedin'])) : ?>
                                <li class="nav-item">
                                    <div class="nav-link">
                                        <span class="mr-1">Username: <?php echo $_SESSION['username'] ?> </span>
                                        <a class="btn btn-sm btn-warning" href="/authors/edit.php">
                                            <span><i class="ti-pencil"></i> Edit Profile</span>
                                        </a>
                                    </div>
                                </li>
                                <li class="nav-item">
                                    <div class="nav-link">
                                        <a class="nav-link-text" href="/articles/myarticle.php">My Article</a>
                                    </div>
                                </li>
                                <li class="nav-item">
                                    <div class="nav-link">
                                        <a class="nav-link-text" href="/logout.php">Logout</a>
                                    </div>
                                </li>
                            <?php else : ?>
                                <li class="nav-item">
                                    <div class="nav-link">
                                        <a class="nav-link-text" href="/login.php">Login</a>
                                    </div>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</header>
<!--================ End Header Area =================-->