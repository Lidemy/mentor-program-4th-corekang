<!-- step 8-1 -->
<?php
  require_once('conn.php');

  if (empty($_POST['nickname']) || empty($_POST['username']) || empty($_POST['password'])) { // step 8-2
    header('Location: register.php?errCode=1'); // step 8-2
    die('資料不齊');
  }

  $nickname = $_POST['nickname'];
  $username = $_POST['username']; // step 8-2
  $password = $_POST['password']; // step 8-2

  $sql = sprintf(
    'INSERT INTO core_users(nickname, username, password) VALUES("%s", "%s", "%s")',
    $nickname, 
    $username,
    $password
  ); // step 8-2

  $result = $conn->query($sql);

  if (!$result) {
    $code = $conn->errno; // step 8-3

    if ($code === 1062) {
      header('Location: register.php?errCode=2');
    } // step 8-3

    die($conn->error);
  }

  header("Location: index.php");
?>
