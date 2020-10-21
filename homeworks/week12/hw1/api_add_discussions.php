<?php
  // Step 3：Create api_add_discussions.php
  require_once('conn.php');
  header('Content-type:application/json;charset=utf-8');
  header('Access-Control-Allow-Origin:*');

  // 錯誤處理
  if (empty($_POST['site_key']) || empty($_POST['nickname']) || empty($_POST['content'])) {
    $json = array(
      'ok' => false,
      'message' => 'Please input missing fields'
    );
    $response = json_encode($json);
    echo $response;
    die();
  }

  $site_key = $_POST['site_key'];
  $nickname = $_POST['nickname'];
  $content = $_POST['content'];

  $sql = 'INSERT INTO core_discussions(site_key, nickname, content) VALUES (?, ?, ?)';
  $stmt = $conn->prepare($sql);
  $stmt->bind_param('sss', $site_key, $nickname, $content);
  $result = $stmt->execute();

  // 錯誤處理
  if (!$result) {
    $json = array(
      'ok' => false,
      'message' => $conn->error // 通常不會 $conn->error，避免顯示敏感資訊
    );
    $response = json_encode($json);
    echo $response;
    die();
  }

  // 產生物件，以 json_encode() 轉變為 JSON 字串後輸出
  $json = array(
    'ok' => true,
    'message' => 'Success'
  );
  $response = json_encode($json);
  echo $response;

  // Test：Postman > http://localhost:8080/week12-board/api_add_discussions.php > Key in parameter
?>
