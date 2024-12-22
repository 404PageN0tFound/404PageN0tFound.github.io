<?php
session_start();

if (!isset($_SESSION['username'])) {
  header('Location: login.html');
  exit;
}

$newsFile = 'news.txt';

// Handle new post submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['newPost'])) {
        $newPost = htmlspecialchars($_POST['newPost']);
        
        // Append the new post to the news file
        file_put_contents($newsFile, $newPost . "\n", FILE_APPEND);
        
        // Redirect to refresh the page and prevent form resubmission on page refresh
        header('Location: welcome.php');
        exit;
    }
}

$news = file_get_contents($newsFile);
$newsArray = explode("\n", $news);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="welcome.css">
  <title>Welcome</title>
</head>
<body>
  <div class="welcome-container">
    <h2>Welcome, <?php echo $_SESSION['username']; ?>!</h2>
    <p>Welcome to Anonypost 🎭</p>

    <h3>Latest Anonyposts</h3>
    <ul>
      <?php
      foreach ($newsArray as $article) {
        echo "<li>$article</li>";
      }
      ?>
    </ul>

    <form action="welcome.php" method="post">
      <label for="newPost">New Post:</label>
      <textarea id="newPost" name="newPost" rows="4" cols="50" required></textarea>
      <br>
      <button type="submit">Post it!</button>
    </form>

    <form action="logout.php" method="post">
      <button type="submit">Logout</button>
    </form>
  </div>
</body>
</html>