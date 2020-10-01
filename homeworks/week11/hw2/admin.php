<!-- Step 7：Create admin.php -->
<?php 
  session_start();
  require_once('conn.php');
  require_once('utils.php');
  require_once('check_permission.php');

  // Step 13：Select all posts
  $stmt = $conn->prepare(
    'SELECT P.id AS id, P.title AS title, P.content AS content, P.created_at AS created_at, U.nickname AS nickname, U.username AS username FROM core_posts AS P LEFT JOIN core_users AS U ON P.username = U.username WHERE P.is_deleted = 0 ORDER BY P.id DESC');
  $result = $stmt->execute();
  if (!$result) {
    die ($conn->error);
  }
  $result = $stmt->get_result();
  // var_dump($result); // object(mysqli_result)#3 (5) { ["current_field"]=> int(0) ["field_count"]=> int(6) ["lengths"]=> NULL ["num_rows"]=> int(2) ["type"]=> int(0) }
  // Step 13：Select all posts (end)
?>

<!DOCTYPE html>

<html>
<head>
  <meta charset="utf-8">
  <title>部落格</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="normalize.css" />
  <link rel="stylesheet" href="style.css" />
</head>

<body>
  <?php include_once('header.php'); ?>
  <section class="banner">
    <div class="banner__wrapper">
      <h1>存放技術之地</h1>
      <div>Welcome to my blog</div>
    </div>
  </section>
  <div class="container-wrapper">
    <div class="container">
      <div class="admin-posts">
        <?php while ($row = $result->fetch_assoc()) { ?>
          <div class="admin-post">
            <div class="admin-post__title">
                <!-- 嗨～歡迎來到程式新手村 feat. 胡斯的異想世界 -->
                <?php echo escape($row['title']); ?>
            </div>
            <div class="admin-post__info">
              <div class="admin-post__created-at">
                <!-- 2020/07/01 10:15 -->
                <?php echo escape($row['created_at']); ?>
              </div>
              <a class="admin-post__btn" href="update_post.php?id=<?php echo escape($row['id']); ?>">編輯</a>
              <a class="admin-post__btn" href="handle_delete_post.php?id=<?php echo escape($row['id']); ?>">刪除</a>
            </div>
          </div>
        <?php } ?>
      </div>
    </div>
  </div>
  <footer>Copyright © 2020 Who's Blog All Rights Reserved.</footer>
</body>
</html>
