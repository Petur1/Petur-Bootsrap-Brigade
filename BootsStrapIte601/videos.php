<?php

session_start();
include 'db.php'; 

if (!isset($_SESSION['username'])) {

    header("Location: login.php");
    exit();

}

$user_age = $_SESSION['age'];

if ($user_age >= 18) {

    $sql = "SELECT * FROM videostable";

}   else {

    $sql = "SELECT * FROM videostable WHERE age_limit <= 18";

    }

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Anime Product Showcase">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/slicknav.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<!-- Header Section Begin -->
<header class="header">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="header__logo">
                    <a href="./index.php"><img src="img/logo.png" alt=""></a>
                </div>
            </div>
            <div class="col-lg-6">
                <nav class="header__menu">
                    <ul>
                        <li class="active"><a href="./index.php">Home</a></li>
                        <li><a href="./categories.html">Categories</a></li>
                        <li><a href="./blog.html">Our Blog</a></li>
                        <li><a href="logout.php">Logout</a></li>
                    </ul>
                </nav>
            </div>
            <div class="col-lg-3">
                <div class="header__right">
                    <a href="#" class="search"><i class="fa fa-search"></i></a>
                    <a href="#" class="cart"><i class="fa fa-shopping-cart"></i></a>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- Header Section End -->

<!-- Product Section Begin -->
<section class="product spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-8 col-sm-8">
                <div class="section-title">
                    <h4>Recent Products</h4>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4">
                <div class="btn__all">
                    <a href="#" class="primary-btn">View All <span class="arrow_right"></span></a>
                </div>
            </div>
        </div>
        <div class="row">
            <?php
            // Display videos dynamically
            if ($result->num_rows > 0) {
                while ($video = $result->fetch_assoc()) {
                    echo "<div class='col-lg-4 col-md-6 col-sm-6'>";
                    echo "<div class='product__item'>";
                    echo "<div class='product__item__pic set-bg' data-setbg='" . $video['thumbnail_url'] . "'>";
                    echo "<div class='ep'>Age Limit: " . $video['age_limit'] . "</div>";
                    echo "<div class='comment'><i class='fa fa-comments'></i> 11</div>";
                    echo "<div class='view'><i class='fa fa-eye'></i> 9141</div>";
                    echo "</div>";
                    echo "<div class='product__item__text'>";
                    echo "<ul>";
                    echo "<li>Active</li>";
                    echo "<li>Movie</li>";
                    echo "</ul>";
                    echo "<h5><a href='#'>" . $video['title'] . "</a></h5>";
                    echo "</div>";
                    echo "</div>";
                    echo "</div>";
                }
            } else {
                echo "<p>No videos available for your age group.</p>";
            }
            ?>
        </div>
    </div>
</section>
<!-- Product Section End -->

<!-- Footer Section Begin -->
<footer class="footer">
    <div class="page-up">
        <a href="#" id="scrollToTopButton"><span class="arrow_carrot-up"></span></a>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="footer__logo">
                    <a href="./index.php"><img src="img/logo.png" alt=""></a>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="footer__nav">
                    <ul>
                        <li class="active"><a href="./index.php">Homepage</a></li>
                        <li><a href="./categories.html">Categories</a></li>
                        <li><a href="./blog.html">Our Blog</a></li>
                        <li><a href="#">Contacts</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-3">
                <p>Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a></p>
            </div>
        </div>
    </div>
</footer>
<!-- Footer Section End -->

<!-- Js Plugins -->
<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/player.js"></script>
<script src="js/jquery.nice-select.min.js"></script>
<script src="js/mixitup.min.js"></script>
<script src="js/jquery.slicknav.js"></script>
<script src="js/owl.carousel.min.js"></script>
<script src="js/main.js"></script>

</body>
</html>
