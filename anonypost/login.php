<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $username = $_POST['username'];
  $password = $_POST['password'];

  // For simplicity, let's use a text file for user storage
  $users = file_get_contents('users.txt');
  $user_array = explode("\n", $users);

  foreach ($user_array as $user) {
    list($stored_username, $stored_password) = explode(',', $user);

    if ($username === $stored_username && password_verify($password, $stored_password)) {
      $_SESSION['username'] = $username;
      header('Location: welcome.php');
      exit;
    }
  }

  echo 'Invalid username or password';
}
?>
