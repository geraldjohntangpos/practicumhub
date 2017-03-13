<?php

  // if($_SESSION['ACCT_TYPE'] == 'student') {
  //   $check = firstLoginConfirm();
  //   if(!$check)
  //     header('Location: /practicumhub/home/setup');
  // }
  //
  if(!isset($baseurl[1]))
    header('Location: /practicumhub/home/'. $_SESSION['ACCT_NO']);

  switch($_SESSION['ACCT_TYPE']) {
    case 'admin':
      require_once('app/controllers/adminController.php');
      break;

    case 'trainer':
      require_once('app/controllers/trainerController.php');
      break;

    case 'adviser':
      require_once('app/controllers/adviserController.php');
      break;

    case 'department admin':
      require_once('app/controllers/deptadminController.php');
      break;

    case 'student':
      require_once('app/controllers/studentController.php');
      break;

    default:
      $role = explode('/', rtrim($_SESSION['ACCT_TYPE'], '/'));
      $_SESSION['ACCT_TYPE'] = $role[0];
      header('Location: /practicumhub/home');

  }


?>
