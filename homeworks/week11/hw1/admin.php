<!-- step 22-1：後台管理 -->
<?php
  session_start();
  require_once('conn.php');
  require_once('utils.php');

  $username = NULL;
  $user = NULL;
  if(!empty($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $user = getUserFromUsername($username);
  }

  // 權限檢查
  if ($user === NULL || $user['role'] !== 'ADMIN') {
    header('Location: index.php');
    exit;
  }

  $stmt = $conn->prepare(
    'SELECT id, role, nickname, username FROM core_users ORDER BY id ASC'
  );
  $result = $stmt->execute();
  
  if (!$result) {
    die ('Error:' . $conn->error);
  }
  $result = $stmt->get_result();
?>

<!DOCTYPE html>

<html lang="en">
<head>
  <meta charset="utf-8">
  <title>後台管理</title>
  <link rel="stylesheet" href="style.css">
  <script src="main.js"></script>
</head>

<body>
  <header class="warning">
    <strong>注意！本站為練習用網站，因教學用途刻意忽略資安實作，註冊時請勿使用任何真實帳號或密碼！</strong>
  </header>

  <main class="board">
    <div class="board-member">
      <?php if (!$username) { ?>
        <a class="board-btn" href="register.php">註冊</a>
        <a class="board-btn" href="login.php">登入</a>
      <?php } else { ?>
        <a class="board-btn" href="logout.php">登出</a>
        <span class="board-btn board-btn-update">編輯暱稱</span>
        <a class="board-btn" href="index.php">回首頁</a>
        <form class="board-form board-form-update hide" method="POST" action="update_user.php">
          <div class="board-nickname">
            <span>新暱稱：</span>
            <input type="text" name="nickname" />
          </div>
          <input class="board-submit" type="submit" />
        </form>
        <h3>你好！<?php echo escape($user['nickname']); ?> </h3>
      <?php } ?>
    </div>

    <h1 class="board-title">後台管理</h1>

    <section>
      <table class="admin-table admin-table-border">
        <tr>
          <th>id</th>
          <th>role</th>
          <th>nickname</th>
          <th>username</th>
          <th colspan="3">變更權限</th>
        </tr>
        <?php
          while ($row = $result->fetch_assoc()) {
        ?>
          <tr>
            <td><?php echo escape($row['id']); ?></td>
            <td><?php echo escape($row['role']); ?></td>
            <td><?php echo escape($row['nickname']); ?></td>
            <td><?php echo escape($row['username']); ?></td>
            <td><a href="handle_update_role.php?role=ADMIN&id=<?php echo escape($row['id']) ?>">管理者</a></td>
            <td><a href="handle_update_role.php?role=NORMAL&id=<?php echo escape($row['id']) ?>">一般使用者</a></td>
            <td><a href="handle_update_role.php?role=BANNED&id=<?php echo escape($row['id']) ?>">停權</a></td>
          </tr>
        <?php } ?>
      </table>
    </section>
  </main>
</body>
</html>
