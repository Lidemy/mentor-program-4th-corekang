<?php
  // Step 4：Create api_comments.php
  require_once('conn.php');
  header('Content-type:application/json;charset=utf-8');
  header('Access-Control-Allow-Origin:*');

  if (empty($_GET['site_key'])) {
    $json = array(
      'ok' => false,
      'message' => 'Please add site_key in url'
    );
    $response = json_encode($json);
    echo $response;
    die();
  }

  $site_key = $_GET['site_key'];

  $sql = 'SELECT id, nickname, content, created_at FROM core_discussions WHERE site_key = ? ' .
     (empty($_GET['before']) ? '' : 'and id < ?') . 
     ' ORDER BY id DESC LIMIT 5'; // Step 6：cursor-based id
  $stmt = $conn->prepare($sql);
  if (empty($_GET['before'])) {
    $stmt->bind_param('s', $site_key);
  } else {
    $stmt->bind_param('si', $site_key, $_GET['before']);
  }  // Step 6：cursor-based id
  $result = $stmt->execute();

  if (!$result) {
    $json = array(
      'ok' => false,
      'message' => $conn->error
    );
    $response = json_encode($json);
    echo $response;
    die();
  }

  $result = $stmt->get_result(); 
  $comments = array(); // $discussions = array();
  while ($row = $result->fetch_assoc()) {
    array_push($comments, array(
      'id' => $row['id'],  // Step 6：cursor-based id
      'nickname' => $row['nickname'],
      'content' => $row['content'],
      'created_at' => $row['created_at']
    ));
  }

  $json = array(
    'ok' => true,
    'comments' => $comments
  );
  $response = json_encode($json);
  echo $response;
?>
