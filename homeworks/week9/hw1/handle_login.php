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

  $sql = sprintf(
    'SELECT * FROM core_users WHERE username="%s" and password="%s"',
    $username,
    $password
  ); // step 10-2

  $result = $conn->query($sql);

  if (!$result) {
    die($conn->error); // step 10-3
  }

  // step 10-4
  if ($result->num_rows) {
    // echo '登入成功！'; // step 11-2
    $_SESSION['username'] = $username; // step 11-2
    header('Location: index.php'); // step 11-2
  } else {
    header('Location: login.php?errCode=2');
  }
?>
