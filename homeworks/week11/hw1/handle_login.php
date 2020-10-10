<!-- step 10-1 -->
<?php
  session_start(); // step 11-1
  require_once('conn.php');
  require_once('utils.php'); // step 11-1

  if (empty($_POST['username']) || empty($_POST['password'])) { // step 10-2
    header('Location: login.php?errCode=1'); // step 10-2
    die('資料不齊');
  }

  $username = $_POST['username'];
  $password = $_POST['password'];

  // step 10-2：登入比對帳號密碼 // step 12-2：改為註解
  /*
  $sql = sprintf(
    'SELECT * FROM core_users WHERE username="%s" and password="%s"',
    $username,
    $password
  );
  */
  
  // step 14-3：改為註解
  // step 12-2：改為先查詢 username
  /*
  $sql = sprintf(
    'SELECT * FROM core_users WHERE username="%s"',
    $username
  );
  $result = $conn->query($sql);
  */
  // step 14-3：Prepared statement 避免 SQL Injection
  $sql = 'SELECT * FROM core_users WHERE username=?';
  $stmt = $conn->prepare($sql);
  $stmt->bind_param('s', $username);
  $result = $stmt->execute();

  if (!$result) {
    die($conn->error); // step 10-3
  }

  $result = $stmt->get_result(); // step 14-3：取回結果
  // step 12-3：如果 num_rows = 0，代表查無此 username，然後離開避免繼續執行程式碼
  if ($result->num_rows === 0) {
    header('Location: login.php?errCode=2');
    exit();
  }

  // step 12-4：如果 num_rows = 1，查到 username，取出結果比對原本、hash 密碼，相同則登入成功
  $row = $result->fetch_assoc();
  if (password_verify($password, $row['password'])) {
    $_SESSION['username'] = $username;
    header('Location: index.php');
  } else {
    header('Location: login.php?errCode=2');
  }

  // step 10-4 // step 12-4：改為註解
  /*
  if ($result->num_rows) {
    // echo '登入成功！'; // step 11-2
    $_SESSION['username'] = $username; // step 11-2
    header('Location: index.php'); // step 11-2
  } else {
    header('Location: login.php?errCode=2');
  }
  */
?>
