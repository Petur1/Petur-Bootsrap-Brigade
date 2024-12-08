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
} else {
    $sql = "SELECT * FROM videostable WHERE age_limit < 18";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="navbardesign.css">
    <link rel="stylesheet" href="indexdesign.css">
    <link rel="stylesheet" href="headerdesign.css">

    <?php include 'header.php'; ?>

</head>

<body>

<div class="header__menu">
    <?php include 'navbar.php'; ?>
</div>

<!-- Hero Section Begin -->

<section class="hero">
    <div class="parallax-background"></div>
    <div class="hero-content">
        <h1>Bootstrap Brigade</h1>
        <h2>Watch the Latest Videos</h2>
        <a href="#product-placement" class="btn-primary">Start Now</a>
    </div>
</section>

<!-- Hero Section End -->

<div id="product-placement"></div>

<!-- Product Section "A" Begin -->

<div class="section-title a">
    <h4>Latest Videos</h4>
</div>

<div class="product-placement a">
    <?php
        $result = $conn->query($sql . " LIMIT 3 OFFSET 3");

        if ($result->num_rows > 0) {

            while ($row = $result->fetch_assoc()) {

                $videoId        = str_replace("https://youtu.be/", "", $row['video_url']);
                $videoThumbnail = "https://img.youtube.com/vi/$videoId/0.jpg";

                echo "<div class='video-item'>";
                echo "<a href='watch.php?id={$row['id']}'>";
                echo "<img src='$videoThumbnail' alt='{$row['title']}' class='video-thumbnail'>";
                echo "</a>";
                echo "<p class='video-title'><strong>{$row['title']}</strong></p>";
                echo "</div>";
            }

        }   else {
                echo "No videos found.";
            }
    ?>
</div>

<!-- Product Section "A" End -->

<!-- Product Section "B" Begin -->

<div class="section-title b">
    <h5>More</h5>
</div>

<div class="product-placement b">
    <?php
        $result = $conn->query($sql . " LIMIT 5");

        if ($result->num_rows > 0) {

            while ($row = $result->fetch_assoc()) {

                $videoId        = str_replace("https://youtu.be/", "", $row['video_url']);
                $videoThumbnail = "https://img.youtube.com/vi/$videoId/0.jpg";

                echo "<div class='video-item'>";
                echo "<a href='watch.php?id={$row['id']}'>";
                echo "<img src='$videoThumbnail' alt='{$row['title']}' class='video-thumbnail'>";
                echo "</a>";
                echo "<p class='video-title'><strong>{$row['title']}</strong></p>";
                echo "</div>";
            }

        }   else {
                echo "No videos found.";
            }
    ?>
</div>

<!-- Product Section "B" End -->

</body>

</html>


<style>
h4, h5 {
    color:              rgb(238, 255, 0);  
    font-size:          60px;
    font-weight:        bold;
    text-align:         center;
    margin-top:         50px;
    margin-bottom:      25px;
}
</style>
