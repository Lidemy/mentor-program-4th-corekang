<!-- Step 12：Create handle_post.php -->
<?php
  session_start();
  require_once('conn.php');
  require_once('utils.php');

  $username = $_SESSION['username'];
  $title = $_POST['title'];
  $content = $_POST['content'];

  if (empty($title) || empty($content)) {
    header('Location: post.php?errCode=1');
    die();
  }

  $sql = 'INSERT INTO core_posts(username, title, content) VALUES(?, ?, ?)';
  $stmt = $conn->prepare($sql);
  $stmt->bind_param('sss', $username, $title, $content);
  $result = $stmt->execute();
  if (!$result) {
    die($conn->error);
  }

  header('Location: admin.php');
?>
