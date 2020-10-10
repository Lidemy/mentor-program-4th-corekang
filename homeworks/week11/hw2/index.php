<!-- Step 2：Create index.php & session_start() -->
<?php
  session_start();
  require_once('conn.php');
  require_once('utils.php');

  // Step 17：Display posts and limit 5
  $stmt = $conn->prepare(
    'SELECT P.id AS id, P.title AS title, P.content AS content, P.created_at AS created_at, U.nickname AS nickname, U.username AS username FROM core_posts AS P LEFT JOIN core_users AS U ON P.username = U.username WHERE P.is_deleted = 0 ORDER BY P.id DESC LIMIT 5');
  $result = $stmt->execute();
  if (!$result) {
    die ($conn->error);
  }
  $result = $stmt->get_result();
  // Step 17：Display posts (end)
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
  <?php include_once('header.php'); ?> <!-- Step 2：include_once header template -->
  <section class="banner">
    <div class="banner__wrapper">
      <h1>存放技術之地</h1>
      <div>Welcome to my blog</div>
    </div>
  </section>
  <div class="container-wrapper">
    <div class="posts">
      <!-- Step 17：Add PHP -->
      <?php while ($row = $result->fetch_assoc()) { ?>
        <article class="post">
          <div class="post__header">
            <div>
              <?php echo escape($row['title']); ?>
            </div>
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
            <?php echo substr(escape($row['content']), 0, 300); ?> <!-- Step 17：PHP substr() -->
          </div>
          <a class="btn-read-more" href="blog.php?id=<?php echo escape($row['id']); ?>">READ MORE</a>
        </article>
      <?php } ?>
      <!-- Step 17：Add PHP (end) -->
      <!-- <article class="post">
        <div class="post__header">
          <div>嗨～歡迎來到程式新手村 feat. 胡斯的異想世界</div>
          <div class="post__actions">
            <a class="post__action" href="#">編輯</a>
          </div>
        </div>
        <div class="post__info">
          2020/07/01 11:11:12
        </div>
        <div class="post__content">郭沫若說過一句富有哲理的話，形成天才的決定因素應該是勤奮。這句話語雖然很短，但令我浮想聯翩。每個人都不得不面對這些問題。在面對這種問題時， 我認為， 生活中，若中午吃什麼出現了，我們就不得不考慮它出現了的事實。中午吃什麼，發生了會如何，不發生又會如何。我們一般認為，抓住了問題的關鍵，其他一切則會迎刃而解。我們都知道，只要有意義，那麼就必須慎重考慮。現在，解決中午吃什麼的問題，是非常非常重要的。所以， 那麼， 一般來講，我們都必須務必慎重的考慮考慮
        </div>
        <a class="btn-read-more">READ MORE</a>
      </article> -->
    </div>
  </div>
  <footer>Copyright © 2020 Who's Blog All Rights Reserved.</footer>
</body>
</html>
