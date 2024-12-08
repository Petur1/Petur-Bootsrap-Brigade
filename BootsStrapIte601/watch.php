<?php

session_start();
include 'db.php'; 


if (!isset($_SESSION['username'])) {
        header("Location: login.php");
    exit();
}


if (isset($_GET['id'])) {
    
    $videoId = $_GET['id'];
    $sql = "SELECT * FROM videostable WHERE id = $videoId";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

    } else {
            echo "Video not found.";
        exit();
        }
}           else {
                echo "No video selected.";
            exit();
            }


$username = $_SESSION['username'];
$sql_user = "SELECT id FROM users WHERE username = '$username'";
$result_user = $conn->query($sql_user);

if ($result_user->num_rows > 0) {
    $user = $result_user->fetch_assoc();
    $userId = $user['id'];

}   else {
        echo "User not found.";
    exit();
    }


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['comment'])) {

    $comment = $_POST['comment'];
    $stmt = $conn->prepare("INSERT INTO account (yourid, video_id, comments) VALUES (?, ?, ?)");
    $stmt->bind_param("iis", $userId, $videoId, $comment);
    
    if ($stmt->execute()) {
        echo "Comment added successfully.";
        header("Location: watch.php?id=" . $videoId);
    exit();

    }   else {
            echo "Error: " . $stmt->error;
        }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"       content="width=device-width, initial-scale=1.0">
    <meta name="description"    content="Watch Video">

    <link rel="stylesheet"      href="navbardesign.css">
    <link rel="stylesheet"      href="headerdesign.css">
    
    <?php include "header.php"?>
</head>

<body>

    <div class="header__menu">
        <?php include 'navbar.php'; ?>
    </div>

<!-- Watch Video Section Begin -->
<section class="watch-video spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="section-title">

                </div>
                <div class="video-container">

                    <?php

                        $videoId = str_replace("https://youtu.be/", "", $row['video_url']);
                        echo "<iframe width='854' height='480' 
                        src='https://www.youtube.com/embed/$videoId' frameborder='0' allowfullscreen></iframe>";
                    
                    ?>

                </div>
            </div>

            <div class="col-lg-4">
                <div class="video-details">

                    <p><strong>Title:</strong>      <?php echo htmlspecialchars($row['title']);     ?>  </p>
                    <p><strong>Age Limit:</strong>  <?php echo htmlspecialchars($row['age_limit']); ?>+ </p>

                    <p><strong>Comments:</strong></p>  

                    <form method="POST" action="">
                        <textarea name="comment" placeholder="Add your comment here" required></textarea><br>
                        <button type="submit">Submit Comment</button>
                    </form>

                    <?php

                        $videoId = mysqli_real_escape_string($conn, $_GET['id']);

                        $sql_comments = "SELECT c.comments, u.username FROM account c 
                        JOIN users u ON c.yourid = u.id 
                        WHERE c.video_id = '$videoId'"; 
                        
                        $comments_result = $conn->query($sql_comments);
                        
                        if ($comments_result->num_rows > 0) {

                            while ($comment_row = $comments_result->fetch_assoc()) {
                                echo "<p><strong>"  .    htmlspecialchars($comment_row['username']) . ":</strong> " 
                                                    .    htmlspecialchars($comment_row['comments']) . "</p>";
                            }

                        }   else {
                                echo "<p>No comments yet.</p>";
                        }
                    ?>
                    
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Watch Video Section End -->

</body>
</html>


<style>

    body {
        background-image:       url('img/rptr.png');
        background-size:        400px 400px;
        background-position:    center;
    }

    p {
    color:              rgb(238, 255, 0);  
    font-size:          25px;
    }

</style>