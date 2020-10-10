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
  // $user = getUserFromUsername($_SESSION['username']); // step 11-8 // step 16-1：改為註解
  // $nickname = $user['nickname']; // step 11-8 // step 16-1：改為註解
  $username = $_SESSION['username']; // step 16-1：直接從 SESSION 取出 username
  $user = getUserFromusername($username); // step 21-16：取得 user 資料

  // step 21-17：沒有權限則導回首頁並離開
  if (!hasPermission($user, 'create', NULL)) {
    header('Location: index.php');
    exit;
  }

  $content = $_POST['content'];
  // step 14-1：改為註解
  /*
  $sql = sprintf(
    'INSERT INTO core_comments(nickname, content) VALUES("%s", "%s")',
    $nickname, 
    $content
  );
  $result = $conn->query($sql);
  */
  // step 14-1：Prepared statement 避免 SQL Injection
  $sql = 'INSERT INTO core_comments(username, content) VALUES(?, ?)'; // ? 代表塞值之處（placeholder） // step 16-1：nickname 改為 username
  $stmt = $conn->prepare($sql); // 將 $sql 傳入 prepare
  $stmt->bind_param('ss', $username, $content); // 'ss' 代表傳入後面兩個字串，將參數綁到 prepare($sql)，結合成完整的 SQL Query // step 16-1：nickname 改為 username
  $result = $stmt->execute(); // 執行綁好的 SQL Query

  if (!$result) {
    die($conn->error);
  }

  header('Location: index.php');
?>
