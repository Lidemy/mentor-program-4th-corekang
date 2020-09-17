<!-- step 11-5 -->
<?php
  session_start();
  session_destroy();
  header('Location: index.php');
?>
