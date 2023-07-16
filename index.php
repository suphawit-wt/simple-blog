<?php
session_start();
require_once('./db/connect.php');

// Query Data
$limit = isset($_GET['limit']) ? $_GET['limit'] : 10;
$sql = "SELECT articles.id, articles.title, articles.body ,articles.create_ts, 
              articles.authors_id, articles.updatetime, articles.publish_sts, authors.penname 
        FROM articles JOIN authors ON articles.authors_id = authors.id
        WHERE articles.publish_sts = 'Y'
        ORDER BY create_ts DESC
        LIMIT 0, ?";
$stmt = $dbconn->prepare($sql);
$stmt->bind_param("s", $limit);
$stmt->execute();
$result = $stmt->get_result();

$articles_list = $result->fetch_all(MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="th" class="no-js">

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <link rel="shortcut icon" href="/assets/img/fav.png" />
  <meta charset="utf-8" />
  <title>BabyBlog</title>

  <link rel="stylesheet" href="/assets/css/font-awesome.min.css" />
  <link rel="stylesheet" href="/assets/css/owl.carousel.css" />
  <link rel="stylesheet" href="/assets/css/bootstrap.css" />
  <link rel="stylesheet" href="/assets/css/themify-icons.css" />
  <link rel="stylesheet" href="/assets/css/main.css" />
  <link rel="stylesheet" href="/assets/css/custom.css" />
</head>

<body>
  <?php require_once "./components/header.php"; ?>

  <!--================ Start Content Area =================-->
  <?php if (!empty($articles_list)) : ?>
    <section class="home-banner-area relative">
      <div class="container-fluid">
        <div class="row">
          <div class="owl-carousel home-banner-owl">
            <?php foreach ($articles_list as $article) : ?>
              <div class="banner-img">
                <img class="img-fluid" src="/assets/img/banner.jpg" alt="banner" />
                <div class="text-wrapper">
                  <a href="#" class="d-flex">
                    <h1>
                      <?php echo $article['title'] ?>
                    </h1>
                  </a>
                </div>
              </div>
            <?php endforeach; ?>
          </div>
        </div>
      </div>
      <div class="social-icons">
        <ul>
          <li>
            <a href="/"><i class="fa fa-facebook"></i></a>
          </li>
          <li>
            <a href="/"><i class="fa fa-twitter"></i></a>
          </li>
          <li>
            <a href="/"><i class="fa fa-pinterest"></i></a>
          </li>
          <li class="diffrent">Share Now</li>
        </ul>
      </div>
    </section>
  <?php endif; ?>
  <!--================ End banner Area =================-->

  <!--================ Start Content Area =================-->
  <section class="blog-post-area section-gap relative">
    <div class="container mt-10">
      <div class="row">
        <div class="col-lg-12">
          <div class="row">
            <?php if (!empty($articles_list)) : ?>
              <?php foreach ($articles_list as $article) : ?>
                <div class="col-lg-12 col-md-12">
                  <div class="single-amenities">
                    <div class="amenities-details">
                      <h5>
                        <a href="#">
                          <?php echo $article['title'] ?>
                        </a>
                      </h5>
                      <div class="amenities-meta mb-10">
                        <a href="#" class=""><span class="ti-calendar"></span><?php echo $article['create_ts'] ?></a>
                        <a href="#" class="ml-20"><span class="ti-comment"></span>0</a>
                      </div>
                      <p>
                        <?php echo $article['body'] ?>
                      </p>
                      <div class="d-flex justify-content-between mt-20">
                        <div class="category">
                          <a href="#">
                            <span class="ti-user mr-1"></span> <?php echo $article['penname'] ?>
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              <?php endforeach; ?>
            <?php else : ?>
              <div class="row">
                <div class="col-lg-12">
                  <h2>ไม่มีบทความ</h2>
                </div>
              </div>
            <?php endif; ?>
          </div>
          <div class="row mt-3">
            <div class="col-lg-12">
              <nav class="blog-pagination justify-content-center d-flex">
                <ul class="pagination">
                  <li class="page-item">
                    <a href="#" class="page-link" aria-label="Previous">
                      <span aria-hidden="true">
                        <span class="ti-arrow-left"></span>
                      </span>
                    </a>
                  </li>
                  <li class="page-item active"><a href="#" class="page-link">01</a></li>
                  <li class="page-item">
                    <a href="#" class="page-link" aria-label="Next">
                      <span aria-hidden="true">
                        <span class="ti-arrow-right"></span>
                      </span>
                    </a>
                  </li>
                </ul>
              </nav>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!--================ End Content Area =================-->

  <?php require_once "./components/footer.php"; ?>

  <script src="/assets/js/jquery-2.2.4.min.js"></script>
  <script src="/assets/js/owl.carousel.min.js"></script>
  <script src="/assets/js/main.js"></script>
</body>

</html>