<!-- step 6-1：新增留言、例外處理 -->
<?php
  session_start(); // step 11-7
  require_once('conn.php');
  require_once('utils.php'); // step 11-7

  if (
    // empty($_POST['nickname']) || // step 11-8
    empty($_POST['content'])) {
    header('Location: index.php?errCode=1'); // step 6-2：例外處理資料不齊
    die('資料不齊');
  }

  // $nickname = $_POST['nickname']; // step 11-8
  // step 11-8
  $user = getUserFromUsername($_SESSION['username']);
  $nickname = $user['nickname'];

  $content = $_POST['content'];
  $sql = sprintf(
    'INSERT INTO core_comments(nickname, content) VALUES("%s", "%s")',
    $nickname, 
    $content
  );

  $result = $conn->query($sql);

  if (!$result) {
    die($conn->error);
  }

  header('Location: index.php');
?>
