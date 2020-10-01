<?php
  require_once('conn.php');

  // step 11-6
  function getUserFromUsername($username) {
    global $conn;
    $sql = sprintf('SELECT * FROM core_users WHERE username = "%s"', $username);
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    return $row;
  }

  // step 13-1：跳脫特殊符號函式
  function escape($str) {
    return htmlspecialchars($str, ENT_QUOTES);
  }

  // step 21-1：操作權限函式
  // $action: update, delete, create
  function hasPermission($user, $action, $comment) {
    if (!isset($user['role'])) {
      return false;
    }

    /* Debug: 
    
    Notice: Trying to access array offset on value of type null in /opt/lampp/htdocs/week11-board/utils.php on line 30

    Notice: Trying to access array offset on value of type null in /opt/lampp/htdocs/week11-board/utils.php on line 34
    
    Notice: Trying to access array offset on value of type null in /opt/lampp/htdocs/week11-board/utils.php on line 40
    
    */

    if ($user['role'] === 'ADMIN') {
      return true;
    } // 具有全部權限

    if ($user['role'] === 'NORMAL') {
      if ($action === 'create') return true; // step 21-15：NORMAL 一定有 create 權限，就不會檢查下一行，所以下一行傳空值沒關係
      return $comment['username'] === $user['username'];
    }

    // step 21-12：權限 BANNED 除了 create 其他回傳 true
    if ($user['role'] === 'BANNED') {
      return $action !== 'create';
    }
  }

  // step 21-4：判斷 ADMIN 函式
  function isAdmin($user) {
    return $user['role'] === 'ADMIN';
  }
?>
