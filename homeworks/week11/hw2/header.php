<!-- Step 3：Create header.php & header template -->
<?php
  // Step 8：Get current path, check if a string contains a specific word
  $uri = $_SERVER['REQUEST_URI'];
  $isAdminPage = (strpos($uri, 'admin.php') !== false);
?>

<nav class="navbar">
  <div class="wrapper navbar__wrapper">
    <div class="navbar__site-name">
      <a href='index.php'>Who's Blog</a>
    </div>
    <ul class="navbar__list">
      <div>
        <li><a href="blog.php">文章列表</a></li>
        <li><a href="#">分類專區</a></li>
        <li><a href="#">關於我</a></li>
      </div>
      <div>
        <?php if (!empty($_SESSION['username'])) { ?>
          <!-- Step 9：Check if current path is admin.php, display post/admin button -->
          <?php if ($isAdminPage) { ?>
            <li><a href="post.php">發布文章</a></li>
          <?php } else { ?>
            <li><a href="admin.php">管理後台</a></li>
          <?php } ?>
          <!-- Step 9：Check if current path is admin.php, display post/admin button (end) -->
          <li><a href="logout.php">登出</a></li>
        <?php } else { ?>
          <li><a href="login.php">登入</a></li>
        <?php } ?>
      </div>
    </ul>
  </div>
</nav>
