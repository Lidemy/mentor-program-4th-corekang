<!-- step 22-3：後台管理後端 -->
<?php
  session_start();
  require_once('conn.php');
  require_once('utils.php');

  if (empty($_GET['id']) || empty($_GET['role'])) {
    // header('Location: update_comment.php?errCode=1&id='.$_POST['id']);
    die('資料不齊');
  }

  $username = $_SESSION['username'];
  $user = getUserFromUsername($username);
  $id = $_GET['id'];
  $role = $_GET['role'];

  if (!$user || $user['role'] !== 'ADMIN') {
    header('Location: admin.php');
    exit;
  }

  $sql = 'UPDATE core_users SET role=? WHERE id=?';
  $stmt = $conn->prepare($sql);
  $stmt->bind_param('si', $role, $id);

  $result = $stmt->execute();
  if (!$result) {
    die($conn->error);
  }

  header('Location: admin.php');
?>
