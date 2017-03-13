<?php

require_once('app/views/admin/adminnav.php');

if(is_numeric($baseurl[1])) {
  require_once('app/views/admin/profile/profileindex.php');
}
else {
  switch($baseurl[1]) {
    case 'updateprofile':
      if(isset($baseurl[2])) {
        if($baseurl[2] != $_SESSION['ACCT_NO']) {
          incError('forbidden');
        }
        else {
          require_once('app/views/admin/profile/updateprofile.php');
        }
      }
      else {
        header('Location: /practicumhub/home/updateprofile/' .$_SESSION['ACCT_NO']);
      }
      break;

    case 'managesubs':
      require_once('app/views/admin/subsManagement/subsindex.php');
      if(isset($baseurl[2])) {
          die('Haha.');
      }
      break;

    case 'addsubs':
      require_once('app/views/admin/subsManagement/addsubs.php');
      if(isset($baseurl[2])) {
        header('Location: /practicumhub/home/addsubs');
      }
      break;

    case 'managepartners':
      require_once('app/views/admin/partnersManagement/partnersindex.php');
      break;

    // case 'addpartner':
    //   if(isset($baseurl[2])) {
    //     switch($baseurl[2]) {
    //       case 'school':
    //         require_once('app/views/admin/partnersManagement/addschool.php');
    //         break;
    //
    //       case 'company':
    //         require_once('app/views/admin/partnersManagement/addcompany.php');
    //         break;
    //
    //       default:
    //         incError();
    //         break;
    //     }
    //   }
    //   else {
    //     incError();
    //   }
    //   break;
    //
    // case 'updatepartner':
    //   if(isset($baseurl[3])) {
    //     if(isset($baseurl[2])) {
    //       switch($baseurl[2]) {
    //         case 'school':
    //           $school = getASchool(array($baseurl[3]));
    //           if(count($school)>0) {
    //             foreach($school as $row) {
    //               $school_name = $row['school_name'];
    //               $school_campus = $row['school_campus'];
    //               $school_address = $row['school_address'];
    //               $contact_no = $row['contact_no'];
    //               require_once('app/views/admin/partnersManagement/updateschool.php');
    //             }
    //           }
    //           else {
    //             incError();
    //           }
    //           break;
    //
    //         case 'company':
    //           $company = getACompany(array($baseurl[3]));
    //           if(count($company)>0) {
    //             foreach($company as $row) {
    //               $company_name = $row['company_name'];
    //               $company_branch = $row['company_branch'];
    //               $company_address = $row['company_address'];
    //               $company_contact = $row['company_contact'];
    //               require_once('app/views/admin/partnersManagement/updatecompany.php');
    //             }
    //           }
    //           else {
    //             incError();
    //           }
    //           break;
    //
    //         default:
    //           incError();
    //           break;
    //       }
    //     }
    //     else {
    //       incError();
    //     }
    //   }
    //   else {
    //     incError();
    //   }
    //   break;
    //
    case 'deletepartner':
      if(isset($baseurl[2])) {
        deletePartner(array($baseurl[2]));
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
