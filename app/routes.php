<?php

  switch ($baseurl[0]) {
    case '/':
      if(isset($_SESSION['ACCT_NO']) && isset($_SESSION['ACCT_TYPE'])) {
        header('Location: /practicumhub/home');
      }
      else {
        require_once('app/views/welcomenav.php');
        require_once('app/views/welcome.php');
      }
      break;

    case 'signin':
      if(isset($_SESSION['ACCT_NO']) && isset($_SESSION['ACCT_TYPE'])) {
        header('Location: /practicumhub/home');
      }
      else {
        require_once('app/views/signin/signinnav.php');
        require_once('app/views/signin/signin.php');
      }
      break;

    case 'register':
      if(isset($_SESSION['ACCT_NO']) && isset($_SESSION['ACCT_TYPE'])) {
        header('Location: /practicumhub/home');
      }
      else {
        require_once('app/controllers/registerController.php');
      }
      break;

    case 'home':
      if(!isset($_SESSION['ACCT_NO']) && !isset($_SESSION['ACCT_TYPE'])) {
        header('Location: /practicumhub/signin?errmsg=loginfirst');
      }
      else {
        require_once('app/controllers/homeController.php');
      }
      break;

    case 'logout':
      require_once('app/views/logout.php');
      break;

    case 'try':
      require_once('app/views/try.php');
      break;

    default:
      require_once('app/views/errors/page404nav.php');
      require_once('app/views/errors/page404.php');
  }

?>
