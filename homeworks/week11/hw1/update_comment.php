<!-- step 17-3：複製 index.php 改為 update_comment.php -->
<?php
  session_start();
  require_once('conn.php');
  require_once('utils.php');

  $id = $_GET['id']; // step 17-4：從網址列取得留言者 id

  $username = NULL;
  $user = NULL;
  if(!empty($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $user = getUserFromUsername($username);
  }

  $stmt = $conn->prepare('SELECT * FROM core_comments WHERE id = ?');
  $stmt->bind_param('i', $id);
  $result = $stmt->execute();
  
  if (!$result) {
    die ('Error:' . $conn->error);
  }
  $result = $stmt->get_result();
  $row = $result->fetch_assoc(); // step 17-5：取出資料庫查詢資料
?>

<!DOCTYPE html>

<html lang="en">
<head>
  <meta charset="utf-8">
  <title>留言板</title>
  <link rel="stylesheet" href="style.css">
</head>

<body>
  <header class="warning">
    <strong>注意！本站為練習用網站，因教學用途刻意忽略資安實作，註冊時請勿使用任何真實帳號或密碼！</strong>
  </header>

  <main class="board">
    <h1 class="board-title">編輯留言</h1>

    <?php
      if (!empty($_GET['errCode'])) {
        $code = $_GET['errCode'];
        $msg = 'Error';

        if ($code === '1') {
          $msg = '資料不齊';
        }

        echo '<h2 class="board-err">錯誤：' . $msg . '</h2>';
      }
    ?>

    <form class="board-form" method="POST" action="handle_update_comment.php">
      <textarea name="content" rows="5"><?php echo $row['content'] ?></textarea><!-- step 17-6：輸入框顯示原本留言 -->
      <input type="hidden" name="id" value="<?php echo $row['id']; ?>" /><!-- step 17-7：必須知道更新哪個 id，將 id 以某個形式帶到下個頁面：放在隱藏 input -->
      <input class="board-submit" type="submit" />
    </form>
  </main>
</body>
</html>
