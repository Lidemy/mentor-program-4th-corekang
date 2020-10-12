<?php
  // Part4-3：Create add_todo.php
  require_once('conn.php');
  header('Content-type:application/json;charset=utf-8');
  header('Access-Control-Allow-Origin:*');

  if (empty($_POST['todo'])) {
    $json = array(
      'ok' => false,
      'message' => 'Please input missing fields'
    );
    $response = json_encode($json);
    echo $response;
    die();
  }

  $todo = $_POST['todo'];

  $sql = 'INSERT INTO core_todos(todo) VALUES (?)';
  $stmt = $conn->prepare($sql);
  $stmt->bind_param('s', $todo);
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

  $json = array(
    'ok' => true,
    'message' => 'Success',
    'id' => $conn->insert_id // After saving, get last ID
  );
  $response = json_encode($json);
  echo $response;
?>
