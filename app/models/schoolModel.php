<?php

  function getSchoolId($data) {
    $conn = dbconn();
    $sql = "SELECT school_id FROM schools WHERE partner_id = ?";
    $pdo = $conn->prepare($sql);
    $pdo->execute($data);
    $res = $pdo->fetchAll();
    $conn = null;
    if(count($res)>0) {
      foreach($res as $row) {
        $school_id = $row['school_id'];
        $retval = $school_id;
      }
    }
    else {
      $retval = 0;
    }

    return $retval;
  }

  function addSchool($data, $partnerkey) {
    $continue = addPartner(array($partnerkey, "school", myDateNow()));
    $partner_id = lastInsertedPartner(array($partnerkey));
    if($continue) {
      $data[] = $partner_id;
      $conn = dbconn();
      $sql = "INSERT INTO schools(school_name, school_campus, school_address, contact_no, partner_id)
      VALUES(?, ?, ?, ?, ?)";
      $pdo = $conn->prepare($sql);
      $ins = $pdo->execute($data);
      $conn = dbconn();

      if($ins) {
        attachSchool(array($partner_id));
      }
      else {
        die("Error adding school.");
      }
    }
    else {
      die("Error adding partner.");
    }
  }

  function attachSchool($data) {
    $school_id = getSchoolId($data);
    $conn = dbconn();
    $sql = "UPDATE dept_admins SET school_id = ? WHERE acct_no = ?";
    $pdo = $conn->prepare($sql);
    $update = $pdo->execute(array($school_id, $_SESSION['ACCT_NO']));
    $conn = null;

    if($update) {
      promoteSchoolAdmin(array($_SESSION['ACCT_NO']));
    }
    else {
      die("Error attaching school.");
    }
  }

  function retrieveSchool($data) {
    $conn = dbconn();
    $sql = "SELECT da.acct_no, da.school_id, s.school_id,
              s.partner_id, s.school_name, s.school_campus,
              s.school_address, s.contact_no, s.school_image, p.partner_id,
              p.partner_key, p.partner_type
            FROM dept_admins da INNER JOIN schools s
            ON da.school_id = s.school_id
            INNER JOIN partners p
            ON s.partner_id = p.partner_id
            WHERE da.acct_no = ? AND p.partner_status = 'ACTIVE'";
    $pdo = $conn->prepare($sql);
    $pdo->execute($data);
    $res = $pdo->fetchAll();
    $conn = null;

    return $res;
  }

  function retrieveAdviserSchool($data) {
    $conn = dbconn();
    $sql = "SELECT da.acct_no, da.school_id, s.school_id,
              s.partner_id, s.school_name, s.school_campus,
              s.school_address, s.contact_no, s.school_image, p.partner_id,
              p.partner_key, p.partner_type
            FROM practicum_advisers da INNER JOIN schools s
            ON da.school_id = s.school_id
            INNER JOIN partners p
            ON s.partner_id = p.partner_id
            WHERE da.acct_no = ? AND p.partner_status = 'ACTIVE'";
    $pdo = $conn->prepare($sql);
    $pdo->execute($data);
    $res = $pdo->fetchAll();
    $conn = null;

    return $res;
  }

  function leaveSchool($data) {
    $conn = dbconn();
    $sql = "UPDATE dept_admins SET school_id = '', department_id = '' WHERE acct_no = ?";
    $pdo = $conn->prepare($sql);
    $leave = $pdo->execute($data);
    $conn = null;

    if($leave) {
      header('Location: /practicumhub/home/manageschool');
    }
    else {
      die("Unable to leave the school.");
    }
  }

  function AdviserLeaveSchool($data) {
    $conn = dbconn();
    $sql = "UPDATE practicum_advisers SET school_id = '', department_id = '' WHERE acct_no = ?";
    $pdo = $conn->prepare($sql);
    $leave = $pdo->execute($data);
    $conn = null;

    if($leave) {
      header('Location: /practicumhub/home/manageschool');
    }
    else {
      die("Unable to leave the school.");
    }
  }

  function getPartnerIdWithKey($data) {
    $conn = dbconn();
    $sql = "SELECT * FROM partners WHERE partner_key = ? AND partner_status = 'ACTIVE'";
    $pdo = $conn->prepare($sql);
    $pdo->execute($data);
    $res = $pdo->fetchAll();
    $conn = null;

    if(count($res)>0) {
      foreach ($res as $row) {
        $partner_id = $row['partner_id'];
      }
    }
    else {
      header('Location: /practicumhub/home/manageschool?errmsg=schoolnotfound');
    }
    return $partner_id;
  }

  function joinSchool($data) {
    $partner_id = getPartnerIdWithKey($data);
    $school_id = getSchoolId(array($partner_id));
    $conn = dbconn();
    $sql = "UPDATE dept_admins SET school_id = ? WHERE dept_admin_id = ?";
    $pdo = $conn->prepare($sql);
    $update = $pdo->execute(array($school_id, $_SESSION['ACCT_NO']));
    $conn = null;

    if($update) {
      header('Location: /practicumhub/home/manageschool');
    }
    else {
      die("Error joining.");
    }
  }

  function joinExistingSchool($data) {
    $checkPartnerKey = checkPartnerKey($data);
    if($checkPartnerKey) {
      $conn = dbconn();
      $sql = "UPDATE dept_admins SET school_id = ? WHERE acct_no = ?";
      $pdo = $conn->prepare($sql);
      $update = $pdo->execute(array($data[0], $_SESSION['ACCT_NO']));
      $conn = null;

      if($update) {
        header('Location: /practicumhub/home/manageschool');
      }
      else {
        die("Error joining.");
      }
    }
    else {
      header('Location: /practicumhub/home/joinschool?errmsg=invalidKey');
    }
  }

  function adviserJoinExistingSchool($data) {
    $checkPartnerKey = checkPartnerKey($data);
    if($checkPartnerKey) {
      $conn = dbconn();
      $sql = "UPDATE practicum_advisers SET school_id = ? WHERE acct_no = ?";
      $pdo = $conn->prepare($sql);
      $update = $pdo->execute(array($data[0], $_SESSION['ACCT_NO']));
      $conn = null;

      if($update) {
        header('Location: /practicumhub/home/manageschool');
      }
      else {
        die("Error joining.");
      }
    }
    else {
      header('Location: /practicumhub/home/joinschool?errmsg=invalidKey');
    }
  }

  function checkPartnerKey($data) {
    $continue = false;
    $conn = dbconn();
    $sql = "SELECT s.school_id, s.partner_id, p.partner_id, p.partner_key, p.partner_status
            FROM schools s INNER JOIN partners p ON s.partner_id = p.partner_id
            WHERE s.school_id = ? AND p.partner_key = ? AND p.partner_status = 'ACTIVE'";
    $pdo = $conn->prepare($sql);
    $pdo->execute($data);
    $res = $pdo->fetchAll();
    $conn = null;

    if(count($res)>0) {
      $continue = true;
    }
    return $continue;
  }

  function retrieveAvailableSchool() {
    $conn = dbconn();
    $sql = "SELECT s.school_id, s.partner_id, s.school_name,
            s.school_address, s.school_campus, s.contact_no,
            s.school_image, p.partner_id, p.partner_status,
            da.dept_admin_id, da.school_id, da.acct_no,
            ua.acct_no, ua.firstname, ua.middlename,
            ua.lastname, ua.type
            FROM schools s
            INNER JOIN partners p ON s.partner_id = p.partner_id
            INNER JOIN dept_admins da ON da.school_id = s.school_id
            INNER JOIN user_account ua ON da.acct_no = ua.acct_no
            WHERE p.partner_status = 'ACTIVE'
            AND ua.type = 'department admin/School admin'
            AND p.partner_type = 'school'";
    $pdo = $conn->prepare($sql);
    $pdo->execute();
    $res = $pdo->fetchAll();
    $conn = null;

    return $res;
  }

  function mySchoolId() {
    $conn = dbconn();
    $sql = "SELECT school_id FROM dept_admins WHERE acct_no = ? LIMIT 1";
    $pdo = $conn->prepare($sql);
    $pdo->execute(array($_SESSION['ACCT_NO']));
    $res = $pdo->fetchAll();
    $conn = null;

    return $res[0]['school_id'];
  }

  function mySchoolIdAdviser() {
    $conn = dbconn();
    $sql = "SELECT school_id FROM practicum_advisers WHERE acct_no = ? LIMIT 1";
    $pdo = $conn->prepare($sql);
    $pdo->execute(array($_SESSION['ACCT_NO']));
    $res = $pdo->fetchAll();
    $conn = null;

    return $res[0]['school_id'];
  }

  function getRole($data) {
    $conn = dbconn();
    $sql = "SELECT type FROM user_account WHERE acct_no = ?";
    $pdo = $conn->prepare($sql);
    $pdo->execute($data);
    $res = $pdo->fetchAll();
    $conn = null;

    if(count($res)>0) {
      foreach ($res as $row) {
        $role = $row['type'];
      }
    }

    return $role;
  }

  function getJoblessStudInMyDept() {
    $myDept = retrieveMyDept()[0]['department_id'];
    $conn = dbconn();
    $sql = "SELECT * FROM students s LEFT JOIN interns i
            ON s.acct_no = i.student_id WHERE i.intern_id IS NULL
            AND s.department_id = ?";
    $pdo = $conn->prepare($sql);
    $pdo->execute(array($myDept));
    $res = $pdo->fetchAll();
    $conn = null;
    return $res;
  }

  function iAmJobless() {
    $bool = true;
    $conn = dbconn();
    $sql = "SELECT * FROM interns WHERE student_id = ?";
    $pdo = $conn->prepare($sql);
    $pdo->execute(array($_SESSION['ACCT_NO']));
    $res = $pdo->fetchAll();
    $conn = null;
    if(count($res)>0) {
      $bool = false;
    }
    return $bool;
  }

?>
