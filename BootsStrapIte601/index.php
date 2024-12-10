<?php
session_start();
include 'db.php';

class Database {
    protected $conn;

    public function __construct() {

        $this->conn = new mysqli('localhost', 'root', '', 'brigadedatabase');
        
        if ($this->conn->connect_error) {

            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function query($sql) {

        return $this->conn->query($sql);
    }
}

class Video {

    private $db;
    private $age;

    public function __construct($db, $age) {

        $this->db   = $db;
        $this->age  = $age;
    }

    public function getVideos() {

        if ($this->age >= 18) {

                return  $this   ->db    ->query("SELECT * FROM videostable");
        } 
            else {
                return  $this   ->db    ->query("SELECT * FROM videostable WHERE age_limit < 18");
            }
    }

    public function getVideoThumbnail($url) {

        $videoId = str_replace("https://youtu.be/", "", $url);
        return "https://img.youtube.com/vi/$videoId/0.jpg";
    }
}

class User {

    public static function checkSession() {

        if (!isset($_SESSION['username'])) {

            header("Location: login.php");
            exit();
        }
    }

    public static function getAge() {
        
        return isset($_SESSION['age']) ? $_SESSION['age'] : 0;
    }
}

User::checkSession();
$users_age = User::getAge();

$db     = new Database();
$video  = new Video($db, $users_age);
$videos = $video->getVideos();
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

        if ($videos->num_rows > 0) {

            while ($row         = $videos   ->fetch_assoc()) {

                $videoThumbnail = $video    ->getVideoThumbnail($row['video_url']);
                echo "<div class='video-item'>";
                echo "<a href   ='watch.php?        id= {$row['id']}'>";
                echo "<img src  ='$videoThumbnail' alt='{$row['title']}' class='video-thumbnail'>";
                echo "</a>";
                echo "<p class  ='video-title'> <strong>{$row['title']}</strong></p>";
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

        $videos     = $video    ->getVideos(); // Reload the videos for more
        if ($videos ->num_rows   > 0) {

            while ($row = $videos->fetch_assoc()) {

                $videoThumbnail = $video->getVideoThumbnail($row['video_url']);
                echo "<div class='video-item'>";
                echo "<a href   ='watch.php?        id= {$row['id']}'>";
                echo "<img src  ='$videoThumbnail' alt='{$row['title']}' class='video-thumbnail'>";
                echo "</a>";
                echo "<p class  ='video-title'> <strong>{$row['title']}</strong></p>";
                echo "</div>";
            }

        } 
            else {
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
