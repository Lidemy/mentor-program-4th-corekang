<!-- step 7-1 -->
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
        <a class="board-btn" href="index.php">回留言板</a> <!-- step 7-2 -->
        <a class="board-btn" href="login.php">登入</a> <!-- step 7-2 -->
    </div>

    <h1 class="board-title">註冊</h1> <!-- step 7-2 -->

    <?php
      if (!empty($_GET['errCode'])) {
        $code = $_GET['errCode'];
        $msg = 'Error';

        // step 8-2：例外處理資料不齊
        if ($code === '1') {
          $msg = '資料不齊';
        }

        // step 8-3：例外處理帳號重複
        if ($code === '2') {
          $msg = '帳號已被註冊';
        }

        echo '<h2 class="board-err">錯誤：' . $msg . '</h2>';
      }
    ?>

    <form class="board-form" method="POST" action="handle_register.php"> <!-- step 7-3 -->
      <div class="board-nickname">
        <span>暱稱：</span>
        <input type="text" name="nickname" />
      </div>
      <!-- step 7-3 -->
      <div class="board-nickname">
        <span>帳號：</span>
        <input type="text" name="username"" />
      </div>
      <!-- step 7-3 -->
      <div class="board-nickname">
        <span>密碼：</span>
        <input type="password" name="password" />
      </div>
      <input class="board-submit" type="submit" />
    </form>
  </main>
</body>
</html>
