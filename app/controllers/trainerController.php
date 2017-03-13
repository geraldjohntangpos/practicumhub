<?php

require_once('app/views/trainer/trainernav.php');

if(is_numeric($baseurl[1])) {
  require_once('app/views/trainer/profile/profileindex.php');
}
else {
  switch($baseurl[1]) {
    case 'updateprofile':
      if(isset($baseurl[2])) {
        if($baseurl[2] != $_SESSION['ACCT_NO']) {
          incError('forbidden');
        }
        else {
          require_once('app/views/trainer/profile/updateprofile.php');
        }
      }
      break;

    case 'managesubs':
      require_once('app/views/trainer/subsManagement/subsindex.php');
      if(isset($baseurl[2])) {
        // die("Haha.");
        header('Location: /practicumhub/home/managesubs');
      }
      break;

    case 'addsubs':
      require_once('app/views/trainer/subsManagement/addsubs.php');
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
        require_once('app/views/trainer/subsManagement/updatesubs.php');
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

    case 'managejobs':
      $myCompany = getMyCompany();
      if(count($myCompany)>0) {
        require_once('app/views/trainer/jobmanagement/jobindex.php');
      }
      else {
        incError('forbidden');
      }
      break;

    case 'addnewcomp':
      $myCompany = getMyCompany();
      if(count($myCompany)>0) {
        incError('forbidden');
      }
      else {
        require_once('app/views/trainer/managecompany/addcompany.php');
      }
      break;

    case 'viewcompany':
      $myCompany = getMyCompany();
      if(count($myCompany)>0) {
        require_once('app/views/trainer/managecompany/managecompindex.php');
      }
      else {
        incError('forbidden');
      }
      break;

    case 'manageinterns':
      require_once('app/views/trainer/internmanagement/internindex.php');
      break;

    case 'delpendingreq':
      if(isset($baseurl[2])) {
        declineReq(array($baseurl[2]));
      }
      else {
        incError();
      }
      break;

    case 'internprofile':
      if(isset($baseurl[2])) {
        $intern = getMyOneIntern(array($baseurl[2]));
        if(count($intern)>0) {
          foreach ($intern as $row) {
            $hiredate = $row['hiredate'];
            $position = $row['position'];
            $firstname = $row['firstname'];
            $middlename = $row['middlename'];
            $lastname = $row['lastname'];
            $hours_done = $row['hours_done'];
            $no_of_hours = $row['no_of_hours'];
            $address = $row['address'];
            $date_of_birth = $row['date_of_birth'];
            $gender = $row['gender'];
            $contactno = $row['contactno'];
            $emailadd = $row['emailadd'];
            $image = $row['image'];
            $intern_id = $row['intern_id'];
            // $dtr_id = $row['dtr_id'];
          }
          require_once('app/views/trainer/internmanagement/internprofile.php');
        }
        else {
          incError();
        }
      }
      else {
        incError();
      }
      break;

    case 'viewinterndtr':
      if(isset($baseurl[2])) {
        $intern_id = $baseurl[2];
        require_once('app/views/trainer/internmanagement/interndtr.php');
      }
      else {
        incError();
      }
      break;

    case 'declinepending':
      if(isset($baseurl[2]) && isset($baseurl[3])) {
        $dtr_id = $baseurl[2];
        $intern_id = $baseurl[3];
        declinePending(array($baseurl[2]), $baseurl[3]);
      }
      else {
        incError();
      }
      break;

    case 'acceptreq':
      if(isset($baseurl[2]) && isset($baseurl[3]) && isset($baseurl[4])) {
        acceptRequest(array($_SESSION['ACCT_NO'], $baseurl[2], concatDateWithTime()), array($baseurl[3]), array($baseurl[4]));
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
