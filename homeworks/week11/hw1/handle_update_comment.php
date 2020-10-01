<!-- step 17-8：複製 update_user.php 改為 handle_update_comment.php -->
<?php
  session_start();
  require_once('conn.php');
  require_once('utils.php');

  if (empty($_POST['content'])) {
    header('Location: update_comment.php?errCode=1&id='.$_POST['id']); // step 17-9：如果沒有輸入內容，導回前一頁
    die('資料不齊');
  }

  $username = $_SESSION['username'];
  $user = getUserFromUsername($username); // step 21-3：取得 user 資料
  $id = $_POST['id'];
  $content = $_POST['content'];

  // $sql = 'UPDATE core_comments SET content=? WHERE id=?'; // step 20-2：改為註解
  $sql = 'UPDATE core_comments SET content=? WHERE id=? and username=?'; // step 20-2：補強權限
  if (isAdmin($user)) {
    $sql = 'UPDATE core_comments SET content=? WHERE id=?';
  } // step 21-5：如果是 AMDIN，修改 SQL Query，具有任意編輯權限
  $stmt = $conn->prepare($sql);
  // $stmt->bind_param('sis', $content, $id, $username); // step 20-2：補強權限 // step 21-6：改為註解
  if (isAdmin($user)) {
    $stmt->bind_param('si', $content, $id); 
  } else {
    $stmt->bind_param('sis', $content, $id, $username); 
  } // step 21-7：判斷權限綁定參數
  $result = $stmt->execute();
  
  if (!$result) {
    die($conn->error);
  }

  header('Location: index.php');
?>
