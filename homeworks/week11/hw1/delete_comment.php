<!-- step 18-2：複製 handle_update_comment.php 改為 delete_comment.php -->
<?php
  session_start();
  require_once('conn.php');
  require_once('utils.php');

  if (empty($_GET['id'])) {
    header('Location: index.php?errCode=1');
    die('資料不齊');
  }

  $id = $_GET['id'];
  $username = $_SESSION['username']; // step 20-1：補強權限
  $user = getUserFromUsername($username); // step 21-8：取得 user 資料

  // $sql = 'DELETE FROM core_comments WHERE id=?'; // step 18-3：改為註解
  // $sql = 'UPDATE core_comments SET is_deleted=1 WHERE id=?'; // step 18-3：改為 soft delete // step 20-1：改為註解
  $sql = 'UPDATE core_comments SET is_deleted=1 WHERE id=? and username=?'; // step 20-1：補強權限
  if (isAdmin($user)) {
    $sql = 'UPDATE core_comments SET is_deleted=1 WHERE id=?';
  } // step 21-9：如果是 AMDIN，修改 SQL Query，具有任意編輯權限
  $stmt = $conn->prepare($sql);
  // $stmt->bind_param('is', $id, $username); // step 20-1：補強權限 // step 21-10：改為註解
  if (isAdmin($user)) {
    $stmt->bind_param('i', $id);
  } else {
    $stmt->bind_param('is', $id, $username);
  } // step 21-11：判斷權限綁定參數
  $result = $stmt->execute();
  
  if (!$result) {
    die($conn->error);
  }

  header('Location: index.php');
?>
