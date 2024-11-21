<?php

session_start();
include 'db.php'; 


if (!isset($_SESSION['username'])) {

    header("Location: login.php");
    exit();

}

$users_age = $_SESSION['age'];

if ($users_age >= 18) {

    $sql = "SELECT * FROM videostable";

}   else {

    $sql = "SELECT * FROM videostable WHERE age_limit < 18";
    }

?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<meta name="description" content="Anime Product Showcase">

    <link rel="stylesheet" href="navstyle.css">

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

            <div class="header__menu">

                <?php include 'navbar.php'; ?>
                
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
                    <h4>Product Placement</h4>
                </div>
            </div>
        </div>
        <div class="row">

            <?php

            $result = $conn->query($sql);

            if ($result->num_rows > 0) {

                while ($row = $result->fetch_assoc()) {
                    
                    $videoId = str_replace("https://youtu.be/", "", $row['video_url']);
                    echo "<div>";
                    echo "<iframe width='560' height='315' src='https://www.youtube.com/embed/$videoId' frameborder='0' allowfullscreen></iframe>";
                    echo "</div>";

                }

            }   else {

                echo "No videos found.";

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
