<!-- Step 10：Create check_permission.php for admin pages -->
<?php
  if (empty($_SESSION['username'])) {
    header('Location: index.php');
    exit;
  }
?>
