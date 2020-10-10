<!-- step 8-1 -->
<?php
  session_start(); // step 12-5：註冊後顯示登入狀態
  require_once('conn.php');

  if (empty($_POST['nickname']) || empty($_POST['username']) || empty($_POST['password'])) { // step 8-2
    header('Location: register.php?errCode=1'); // step 8-2
    die('資料不齊');
  }

  $nickname = $_POST['nickname'];
  $username = $_POST['username']; // step 8-2
  // $password = $_POST['password']; // step 8-2 // step 12-1：改為註解
  $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // step 12-1：註冊時密碼經過 hash 存入資料庫

  // step 14-2：改為註解
  /*
  $sql = sprintf(
    'INSERT INTO core_users(nickname, username, password) VALUES("%s", "%s", "%s")',
    $nickname, 
    $username,
    $password
  ); // step 8-2
  $result = $conn->query($sql);
  */
  // step 14-2：Prepared statement 避免 SQL Injection
  $sql = 'INSERT INTO core_users(nickname, username, password) VALUES(?, ?, ?)';
  $stmt = $conn->prepare($sql);
  $stmt->bind_param('sss', $nickname, $username, $password);
  $result = $stmt->execute();

  if (!$result) {
    $code = $conn->errno; // step 8-3

    if ($code === 1062) {
      header('Location: register.php?errCode=2');
    } // step 8-3

    die($conn->error);
  }
  
  $_SESSION['username'] = $username; // step 12-5：註冊後顯示登入狀態
  header("Location: index.php");
?>
