class User {
    private $username;
    private $age;

    public function __construct($username, $age) {
        $this->username = $username;
        $this->age = $age;
    }

    public function getAge() {
        return $this->age;
    }
}

class Video {
    private $title;
    private $ageLimit;

    public function __construct($title, $ageLimit) {
        $this->title = $title;
        $this->ageLimit = $ageLimit;
    }

    public function getTitle() {
        return $this->title;
    }

    public function getAgeLimit() {
        return $this->ageLimit;
    }
}

class Database {
    private $conn;

    public function __construct($db_host, $db_user, $db_password, $db_name) {
        // Connect to the database
        $this->conn = new mysqli($db_host, $db_user, $db_password, $db_name);
    }

    public function getVideosForUser(User $user) {
        $sql = "SELECT * FROM videostable";
        if ($user->getAge() < 18) {
            $sql .= " WHERE age_limit <= 18";
        }
        $result = $this->conn->query($sql);

        $videos = [];
        while ($row = $result->fetch_assoc()) {
            $videos[] = new Video($row['title'], $row['age_limit']);
        }
        return $videos;
    }
}

// Assuming user authentication is done and user object is created
$user = new User($_SESSION['username'], $_SESSION['age']);

$db = new Database(/* database connection details */);
$videos = $db->getVideosForUser($user);

// Display videos in HTML
foreach ($videos as $video) {
    // ... HTML output using $video->getTitle() and $video->getAgeLimit()
}