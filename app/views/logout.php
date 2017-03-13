<?php
  // session_destroy();
  unset($_SESSION['ACCT_NO']);
  unset($_SESSION['TYPE']);
  header('Location: /practicumhub');
?>
