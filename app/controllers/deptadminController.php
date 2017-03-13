<?php

require_once('app/views/deptadmin/deptadminnav.php');

      if(is_numeric($baseurl[1])) {
        require_once('app/views/deptadmin/profile/profileindex.php');
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
            require_once('app/views/deptadmin/subsManagement/subsindex.php');
            // checkNextBaseUrl("home/managesubs", 2);
            if(isset($baseurl[2])) {
              // die("Haha.");
              header('Location: /practicumhub/home/managesubs');
            }
            break;

          case 'addsubs':
            require_once('app/views/deptadmin/subsManagement/addsubs.php');
            // checkNextBaseUrl('home/addsubs', 2);
            if(isset($baseurl[2])) {
            //   // die('Haha.');
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
              require_once('app/views/deptadmin/subsManagement/updatesubs.php');
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

          case 'manageprog':
            require_once('app/views/deptadmin/progManagement/progindex.php');
            break;

          case 'addprog':
            $myDept = retrieveMyDept();
            foreach($myDept as $row) {
              $department_id = $row['department_id'];
            }
            if($department_id==0) {
              incError('forbidden');
            }
            else {
              require_once('app/views/deptadmin/progManagement/addprog.php');
            }
            break;

          case 'updateprog':
            if(!isset($baseurl[2])){
              require_once('app/views/errors/page404.php');
            }
            else {
              $myProg = retrieveOneProg(array($baseurl[2]));
              if(count($myProg)>0) {
                foreach ($myProg as $row) {
                  $program_id = $row['program_id'];
                  $program_title = $row['program_title'];
                  $program_description = $row['program_description'];
                  $semester = $row['semester'];
                  $school_year = $row['school_year'];
                  $startdate = $row['startdate'];
                  $enddate = $row['enddate'];
                  $no_of_hours = $row['no_of_hours'];
                  $status = $row['status'];
                  // $dept_admin_id = $row['dept_admin_id'];
                }
                require_once('app/views/deptadmin/progManagement/updateprog.php');
              }
              else {
                incError();
              }
            }
            break;

          case 'deleteprog':
            if(isset($baseurl[2])) {
              deleteProg(array($baseurl[2]));
            }
            else {
              incError();
            }
            break;

          case 'manageschool':
            require_once('app/views/deptadmin/schoolManagement/manageschoolindex.php');
            break;

          case 'addschool':
            $mySchool = retrieveSchool(array($_SESSION['ACCT_NO']));
            $mySubs = retrieveMySubs(array($_SESSION['ACCT_NO']));
            if(count($mySchool)>0) {
              incError('forbidden');
            }
            else if(count($mySubs)==0) {
              incError('notsubscribbed');
            }
            else {
              require_once('app/views/deptadmin/schoolManagement/addschool.php');
            }
            break;

          case 'editschool':
            break;

          case 'leaveschool':
            $mySchool = retrieveSchool(array($_SESSION['ACCT_NO']));
            $myRole = getRole(array($_SESSION['ACCT_NO']));
            if(count($mySchool)>0) {
              if($myRole == "department admin") {
                leaveSchool(array($_SESSION['ACCT_NO']));
              }
              else {
                incError('forbidden');
              }
            }
            else {
              incError('forbidden');
            }
            break;

          case 'joinschool':
            $mySchool = retrieveSchool(array($_SESSION['ACCT_NO']));
            if(count($mySchool)>0) {
              incError('forbidden');
            }
            else {
              require_once('app/views/deptadmin/schoolManagement/joinschool.php');
            }
            break;

          case 'managedept':
            break;

          case 'addnewdept':
            $mySchool = retrieveSchool(array($_SESSION['ACCT_NO']));
            $myDept = retrieveMyDept();
            if(count($mySchool)==0 && count($myDept)>0) {
              incError('forbidden');
            }
            else {
              require_once('app/views/deptadmin/deptmanagement/addnewdept.php');
            }
            break;

          case 'updatedept':
            break;

          case 'deletedept':
            break;

          case 'joindept':
            break;

          case 'viewjobs':
            require_once('app/views/deptadmin/jobfeed/jobfeedindex.php');
            break;

            case 'delpendingreq':
              if(isset($baseurl[2])) {
                delReq(array($baseurl[2]));
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
