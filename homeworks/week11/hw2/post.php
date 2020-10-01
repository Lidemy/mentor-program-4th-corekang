<!-- Step 11：Create post.php -->
<?php
  session_start();
  require_once('conn.php');
  require_once('utils.php');
  require_once('check_permission.php');
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
      <div class="edit-post">
        <form action="handle_post.php" method="POST"> <!-- Step 11：Edit action value -->
          <div class="edit-post__title">
            發布文章：
          </div>
          <div class="edit-post__input-wrapper">
            <input class="edit-post__input" name="title" placeholder="請輸入文章標題" />
          </div>
          <div class="edit-post__input-wrapper">
            <textarea class="edit-post__content" name="content" rows="20"></textarea>
          </div>
          <div class="edit-post__btn-wrapper">
            <input class="edit-post__btn" type="submit" value="送出" />
          </div>
        </form>
      </div>
    </div>
  </div>
  <footer>Copyright © 2020 Who's Blog All Rights Reserved.</footer>
</body>
</html>