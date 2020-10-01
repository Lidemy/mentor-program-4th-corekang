<!-- Step 6：Create logout.php -->
<?php
  session_start();
  session_destroy();
  header('Location: index.php');
?>
