<?php
  session_start(); // step 11-3
  require_once('conn.php'); // step 3：引入 conn.php
  require_once('utils.php'); // step 11-3

  // step 12-4
  $username = NULL;
  $user = NULL; // step 15-3
  if(!empty($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $user = getUserFromUsername($username); // step 15-4：取出整個 $user
  }

  // step 19-1：分頁功能
  $page = 1; // step 19-1：定義分頁功能變數，位於第 1 頁
  if (!empty($_GET['page'])) {
    $page = intval($_GET['page']); // 從網址列取得目前所在頁數並轉為數字
  }
  $items_per_page = 5; // step 19-1：定義分頁功能變數，每頁 5 筆資料
  $offset = ($page - 1) * $items_per_page;

  // step 4：查詢資料、例外處理
  // $result = $conn->query('SELECT * FROM core_comments ORDER BY id DESC'); // step 14-4：改為註解
  // $stmt = $conn->prepare('SELECT * FROM core_comments ORDER BY id DESC'); // step 14-4：Prepared statement 避免 SQL Injection // step 16-3：改為註解
  $stmt = $conn->prepare(
    'SELECT '.
      'C.id AS id, C.content AS content, '.
      'C.created_at AS created_at, U.nickname AS nickname, U.username AS username '.
    'FROM core_comments AS C '.
    'LEFT JOIN core_users AS U ON C.username = U.username '.
    'WHERE C.is_deleted IS NULL '.
    'ORDER BY C.id DESC '.
    'LIMIT ? OFFSET ? '
  ); // step 16-3：加入 INNER JOIN // step 18-4：所有留言顯示未刪除留言 is_deleted IS NULL // step 19-1：加入 LIMIT、OFFEST
  $stmt->bind_param('ii', $items_per_page, $offset); // step 19-1：計算分頁
  $result = $stmt->execute(); // step 14-4
  
  if (!$result) {
    die ('Error:' . $conn->error);
  }
  $result = $stmt->get_result(); // step 14-4：執行成功再取回結果
?>

<!-- step 1：刻版 -->
<!DOCTYPE html>

<html lang="en">
<head>
  <meta charset="utf-8">
  <title>留言板</title>
  <link rel="stylesheet" href="style.css">
  <?php if ($username) { ?>
    <script src="main.js"></script> <!-- step 15-7：點擊後才顯示修改暱稱表單 -->
  <?php } ?>
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
        <span class="board-btn board-btn-update">編輯暱稱</span><!-- step 15-6：點擊後才顯示修改暱稱表單 -->
        <!-- step 22-2：後台管理按鈕 -->
        <?php if ($user && $user['role'] === 'ADMIN') { ?>
          <a class="board-btn" href="admin.php">後台管理</a>
        <?php } ?>
        <!-- step 15-1：修改暱稱表單 -->
        <form class="board-form board-form-update hide" method="POST" action="update_user.php">
          <div class="board-nickname">
            <span>新暱稱：</span>
            <input type="text" name="nickname" />
          </div>
          <input class="board-submit" type="submit" />
        </form>
        <h3>你好！<?php echo $user['nickname']; ?> </h3><!-- step 15-5：修改暱稱後即時顯示 -->
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
      <!-- step 21-13：如果已經登入但沒有新增留言權限，顯示已被停權（以下 2 行） -->
      <?php if ($username && !hasPermission($user, 'create', NULL)) { ?>
        <h3>你已被停權</h3>
      <?php } else if ($username) { ?> <!-- step 21-14：if 改為 else if -->
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
          // print_r($row); // step 16-3：查看此步驟輸出結果，確認無資料的問題 -->
      ?>
        <div class="card">
          <div class="card-avatar"></div>
          <div class="card-body">
            <div class="card-info">
              <span class="card-author">
                <?php echo escape($row['nickname']); ?> <!-- step 13-2：內容跳脫後顯示 --> <!-- step 16-1：nickname 改為 username --> <!-- step 16-3：username 改回 nickname -->
                (@<?php echo escape($row['username']); ?>)<!-- step 16-4：因為 nickname 可能重複，顯示 username -->
              </span>
              <span class="card-time">
                <?php echo escape($row['created_at']); ?> <!-- step 13-2：內容跳脫後顯示 --> <!-- step 16-3：因為兩個資料表都有欄位 created_at，改為 core_comments.created_at 無資料，採用別名而改回 -->
              </span>
              <!-- step 17-2：當發文者等於登入者，只能編輯個人留言 -->
              <?php // if ($row['username'] === $username) { ?> <!-- step 21-2：改為註解 -->
              <?php if (hasPermission($user, 'update', $row)) { ?> <!-- step 21-2：改為呼叫操作權限函式 -->
                <a href="update_comment.php?id=<?php echo $row['id']; ?>">編輯</a><!-- step 17-1：新增編輯留言按鈕 -->
                <a href="delete_comment.php?id=<?php echo $row['id']; ?>">刪除</a><!-- step 18-1：新增刪除留言按鈕 -->
              <?php } ?>
            </div>
            <p class="card-content">
              <?php echo escape($row['content']); ?> <!-- step 13-2：內容跳脫後顯示 -->
            </p>
          </div>
        </div>
      <?php } ?>
    </section>

    <!-- step 19-2：顯示總筆數與分頁 start -->
    <div class="board-hr"></div>
    <?php 
      $stmt = $conn->prepare('SELECT COUNT(id) AS count FROM core_comments WHERE is_deleted IS NULL');
      $result = $stmt->execute();
      $result = $stmt->get_result();
      $row = $result->fetch_assoc();
      $count = $row['count'];
      $total_page = ceil($count / $items_per_page); // 無條件進位 elil()
    ?>
    <div class="board-page">
      <span>總共 <?php echo $count ?> 筆留言，頁數：</span>
      <span><?php echo $page ?>／<?php echo $total_page ?></span>
      <div class="board-paginator">
        <?php if ($page != 1) { ?>
          <a href="index.php?page=1">首頁</a>
          <a href="index.php?page=<?php echo $page - 1 ?>">上一頁</a>
        <?php } ?>
        <?php if ($page != $total_page) { ?>
          <a href="index.php?page=<?php echo $page + 1 ?>">下一頁</a>
          <a href="index.php?page=<?php echo $total_page ?>">最末頁</a>
        <?php } ?>
      </div>
    </div>
    <!-- step 19-2：顯示總筆數與分頁 end -->
  </main>
</body>
</html>
