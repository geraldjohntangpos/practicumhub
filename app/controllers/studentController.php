<?php

  $check = firstLoginConfirm();
  if($check != 'go') {
    require_once('app/views/students/setup/setupnav.php');
  }
  else {
    require_once('app/views/students/studentnav.php');
  }

  if(is_numeric($baseurl[1])) {
    setupConf();
    require_once('app/views/students/profile/profileindex.php');
    if(isset($baseurl[2])) {
      header('Location: /practicumhub/home');
    }
  }
  else {
    switch ($baseurl[1]) {
      case 'updateprofile':
        setupConf();
        if(isset($baseurl[2])) {
          if($baseurl[2] != $_SESSION['ACCT_NO']) {
            incError('forbidden');
          }
          else {
            require_once('app/views/students/profile/updateprofile.php');
          }
        }
        break;

      case 'manageclass':
        setupConf();
        require_once('app/views/students/class/classindex.php');
        break;

      case 'setup':
        require_once('app/views/students/setup/setupschool.php');
        switch($check) {
          case 'setup1':
            break;
          case 'setup2':
            header('Location: /practicumhub/home/setupdept');
            break;
          default:
            incError('forbidden');
            break;
        }
        break;

      case 'setupdept':
        require_once('app/views/students/setup/setupdept.php');
        switch($check) {
          case 'setup1':
            header('Location: /practicumhub/home/setupschool');
            break;
          case 'setup2':
            break;
          default:
            incError('forbidden');
            break;
        }
        break;

      case 'managedtr':
        require_once('app/views/students/dtrmanagement/dtrindex.php');
        break;

      case 'logindtr':
        $intern_id = getMyInternId();
        $time_in = concatDateWithTime();
        loginDtr(array($intern_id, $time_in));
        break;

      case 'logoutdtr':
        $time_out = concatDateWithTime();
        $dtr_id = getMyDtr()[0]['dtr_id'];
        logoutDtr(array($time_out, $dtr_id));
        break;

      case 'viewjobs':
        require_once('app/views/students/jobfeed/jobfeedindex.php');
        break;

      case 'delpendingreq':
        if(isset($baseurl[2])) {
          delReq(array($baseurl[2]));
        }
        else {
          incError();
        }
        break;

      case 'apply':
        if(isset($baseurl[2])) {
          addRequest(array($baseurl[2], $_SESSION['ACCT_NO']));
        }
        else {
          incError();
        }
        break;

      default:
        incError();
        break;
    }
  }

?>
