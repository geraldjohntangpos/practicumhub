<?php
require_once('app/views/register/registernav.php');
switch ($baseurl[1]) {
  case 'student':
    require_once('app/views/register/student.php');
    break;

  case 'adviser':
    require_once('app/views/register/adviser.php');
    break;

  case 'deptadmin':
    require_once('app/views/register/deptadmin.php');
    break;

  case 'trainer':
    require_once('app/views/register/trainer.php');
    break;

  default:
    require_once('app/views/errors/page404nav.php');
    require_once('app/views/errors/page404.php');
    break;
}

?>
