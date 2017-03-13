<?php

require_once('app/views/adviser/advisernav.php');

if(is_numeric($baseurl[1])) {
  require_once('app/views/adviser/profile/profileindex.php');
  // checkNextBaseUrl("home", 2);
  if(isset($baseurl[2])) {
    header('Location: /practicumhub/home');
  }
}
else {
  switch($baseurl[1]) {
    case 'updateprofile':
      if(isset($baseurl[2])) {
        if($baseurl[2] != $_SESSION['ACCT_NO']) {
          incError('forbidden');
        }
        else {
          require_once('app/views/adviser/profile/updateprofile.php');
        }
      }
      break;

    case 'managesubs':
      require_once('app/views/adviser/subsManagement/subsindex.php');
      if(isset($baseurl[2])) {
        // die("Haha.");
        header('Location: /practicumhub/home/managesubs');
      }
      break;

    case 'addsubs':
      require_once('app/views/adviser/subsManagement/addsubs.php');
      if(isset($baseurl[2])) {
        // die('Haha.');
        header('Location: /practicumhub/home/addsubs');
      }
      break;

    case 'updatesubs':
      $mySub = retrieveOneSub(array($baseurl[2]));
      if(count($mySub)>0) {
        foreach ($mySub as $row) {
          $keygen = $row['keygen'];
          $subplan_no = $row['subplan_no'];
          $description = $row['description'];
        }
        require_once('app/views/adviser/subsManagement/updatesubs.php');
      }
      else {
        incError();
      }
      break;

    case 'deletesubs':
      if(isset($baseurl[2])) {
        deletesubs(array($baseurl[2]));
      }
      else {
        incError();
      }
      break;

    case 'manageclass':
      require_once('app/views/adviser/classManagement/manageclassindex.php');
      break;

    case 'addclass':
      require_once('app/views/adviser/classManagement/addclass.php');
      break;

    case 'manageschool':
      require_once('app/views/adviser/schoolManagement/manageschoolindex.php');
      break;

    case 'joinschool':
      require_once('app/views/adviser/schoolManagement/joinschool.php');
      break;

    case 'leaveschool':
      break;

    case 'joindept':
      $myDept = retrieveMyDeptAdviser();
      if($myDept[0]['department_id'] != 0) {
        incError('forbidden');
      }
      else {
        require_once('app/views/adviser/deptmanagement/joindept.php');
      }
      break;

    case 'leavedept':
      break;

    case 'managedtr':
      if(isset($baseurl[2])) {
        require_once('app/views/adviser/classManagement/dtr.php');
      }
      else {
        incError();
      }
      break;

    default:
    //  require_once('app/views/errors/page404nav.php');
    incError();
  }
}


?>
