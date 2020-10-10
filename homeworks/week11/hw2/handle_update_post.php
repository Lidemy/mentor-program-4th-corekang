<!-- Step 16：Create handle_update_post.php -->
<?php
  session_start();
  require_once('conn.php');
  require_once('utils.php');
  require_once('check_permission.php');

  $id = $_POST['id']; /* Another way: update_post.php > <form action="handle_update_post.php?id=<?php echo $row['id']; ?>" method="POST"> > $id = $_GET['id']; */
  $title = $_POST['title'];
  $content = $_POST['content'];

  /* Step 16：PHP redirect last page, because last page may be index.php / blog.php?id=<?php echo escape($row['id']); ?> / admin.php */
  $page = $_POST['page'];
  if (empty($id) || empty($title) || empty($content)) {
    header('Location: ' . $page);
    die();
  }

  $sql = 'UPDATE core_posts SET title = ?, content = ? WHERE id = ?';
  $stmt = $conn->prepare($sql);
  $stmt->bind_param('ssi', $title, $content, $id);
  $result = $stmt->execute();
  if (!$result) {
    die($conn->error);
  }

  header('Location: ' . $page);
?>
