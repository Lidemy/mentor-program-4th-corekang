<?php
  session_start(); // step 11-3
  require_once('conn.php'); // step 3：引入 conn.php
  require_once('utils.php'); // step 11-3

  // step 12-4
  $username = NULL;
  if(!empty($_SESSION['username'])) {
    $username = $_SESSION['username'];
  }

  // step 4：查詢資料、例外處理
  $result = $conn->query('SELECT * FROM core_comments ORDER BY id DESC');
  if (!$result) {
    die ('Error:' . $conn->error);
  }
?>

<!-- step 1：刻版 -->
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
    <div class="board-member">
      <!-- step 11-4 -->
      <?php if (!$username) { ?>
        <a class="board-btn" href="register.php">註冊</a> <!-- step 7-2 -->
        <a class="board-btn" href="login.php">登入</a> <!-- step 7-2 -->
      <?php } else { ?>
        <a class="board-btn" href="logout.php">登出</a>
        <h3>你好！<?php echo $username; ?></h3>
      <?php } ?>
    </div>

    <h1 class="board-title">留言</h1>

    <!-- step 6-2：例外處理資料不齊 -->
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

    <form class="board-form" method="POST" action="handle_add_comment.php">
      <!-- step 11-8 -->
      <!-- <div class="board-nickname">
        <span>暱稱：</span>
        <input type="text" name="nickname" />
      </div> -->
      <textarea name="content" rows="5"></textarea>
      <!-- step 11-8 -->
      <?php if ($username) { ?>
        <input class="board-submit" type="submit" />
      <?php } else { ?>
        <h3>請登入發布留言</h3>
      <?php } ?>
    </form>

    <div class="board-hr"></div>

    <section>
      <!-- step 5：讀取資料、內容對應料庫欄位 -->
      <?php
        while ($row = $result->fetch_assoc()) {
      ?>
        <div class="card">
          <div class="card-avatar"></div>
          <div class="card-body">
            <div class="card-info">
              <span class="card-author">
                <?php echo $row['nickname']; ?>
              </span>
              <span class="card-time">
                <?php echo $row['created_at']; ?>
              </span>
            </div>
            <p class="card-content">
              <?php echo $row['content']; ?>
            </p>
          </div>
        </div>
      <?php } ?>
    </section>
  </main>
</body>
</html>
