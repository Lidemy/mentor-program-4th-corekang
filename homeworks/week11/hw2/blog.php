<!-- Step 18：Create blog.php -->
<?php
  session_start();
  require_once('conn.php');
  require_once('utils.php');

  $id = intval(@$_GET['id']); // intval()：convert a string to a number, @：debug PHP Notice: Undefined index

  $stmt = $conn->prepare(
    'SELECT P.id AS id, P.title AS title, P.content AS content, P.created_at AS created_at, U.nickname AS nickname, U.username AS username FROM core_posts AS P LEFT JOIN core_users AS U ON P.username = U.username WHERE P.id = ?');
  $stmt->bind_param('i', $id);
  $result = $stmt->execute();
  if (!$result) {
    die ($conn->error);
  }
  $result = $stmt->get_result();
  $row = $result->fetch_assoc();

  if (empty($id)) {
    // header('Location: index.php?errCode=1');
    // die();
    $stmt = $conn->prepare(
      'SELECT P.id AS id, P.title AS title, P.content AS content, P.created_at AS created_at, U.nickname AS nickname, U.username AS username FROM core_posts AS P LEFT JOIN core_users AS U ON P.username = U.username WHERE P.is_deleted = 0 ORDER BY P.id DESC;');
    $result = $stmt->execute();
    if (!$result) {
      die ($conn->error);
    }
    $result = $stmt->get_result();
  }
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
    <div class="posts">
      <?php if (empty($row['id'])) { ?>
        <?php while ($row = $result->fetch_assoc()) { ?>
          <article class="post">
            <div class="post__header">
              <div><?php echo escape($row['title']); ?></div>
              <div class="post__actions">
                <?php if (!empty($_SESSION['username'])) { ?>
                  <a class="post__action" href="update_post.php?id=<?php echo escape($row['id']); ?>">編輯</a>
                <?php } ?>
              </div>
            </div>
            <div class="post__info">
              <?php echo escape($row['created_at']); ?>
            </div>
            <div class="post__content">
              <?php echo escape($row['content']); ?>
            </div>
          </article>
        <?php } ?>
      <?php } else { ?>
        <article class="post">
          <div class="post__header">
            <div><?php echo escape($row['title']); ?></div>
            <div class="post__actions">
              <?php if (!empty($_SESSION['username'])) { ?>
                <a class="post__action" href="update_post.php?id=<?php echo escape($row['id']); ?>">編輯</a>
              <?php } ?>
            </div>
          </div>
          <div class="post__info">
            <?php echo escape($row['created_at']); ?>
          </div>
          <div class="post__content">
            <?php echo escape($row['content']); ?>
          </div>
        </article>
      <?php } ?>
    </div>
  </div>
  <footer>Copyright © 2020 Who's Blog All Rights Reserved.</footer>
</body>
</html>