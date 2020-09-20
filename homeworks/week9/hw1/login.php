<!-- step 9-1 -->
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
        <a class="board-btn" href="index.php">回留言板</a>
        <a class="board-btn" href="register.php">註冊</a> <!-- step 9-2 -->
    </div>

    <h1 class="board-title">登入</h1> <!-- step 9-2 -->

    <?php
      if (!empty($_GET['errCode'])) {
        $code = $_GET['errCode'];
        $msg = 'Error';

        if ($code === '1') {
          $msg = '資料不齊';
        }

        if ($code === '2') {
          $msg = '帳號或密碼輸入錯誤'; // step 10-4
        }

        echo '<h2 class="board-err">錯誤：' . $msg . '</h2>';
      }
    ?>

    <form class="board-form" method="POST" action="handle_login.php"> <!-- step 9-2 -->
      <div class="board-nickname">
        <span>帳號：</span>
        <input type="text" name="username"" />
      </div>
      <div class="board-nickname">
        <span>密碼：</span>
        <input type="password" name="password" />
      </div>
      <input class="board-submit" type="submit" />
    </form>
  </main>
</body>
</html>
