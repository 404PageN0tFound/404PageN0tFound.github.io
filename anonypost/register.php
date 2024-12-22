<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $newUsername = $_POST['newUsername'];
  $newPassword = password_hash($_POST['newPassword'], PASSWORD_DEFAULT);

  // For simplicity, let's use a text file for user storage
  $users = file_get_contents('users.txt');

  // Check if the username already exists
  if (strpos($users, $newUsername) !== false) {
    echo 'Username already exists. Please choose a different username.';
    exit;
  }

  // Add the new user to the file
  file_put_contents('users.txt', "$newUsername,$newPassword\n", FILE_APPEND);

  echo 'Registration successful! You can now login.';
}
?>
