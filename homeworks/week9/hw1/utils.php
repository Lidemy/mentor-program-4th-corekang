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
?>
