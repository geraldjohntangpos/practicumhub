<?php

  function firstLoginConfirm() {
    $continue = 'go';
    $conn = dbconn();
    $sql = "SELECT school_id, department_id, student_id, acct_no
            FROM students WHERE acct_no = ? LIMIT 1";
    $pdo = $conn->prepare($sql);
    $pdo->execute(array($_SESSION['ACCT_NO']));
    $res = $pdo->fetchAll();
    $conn = null;
    $school = $res[0]['school_id'];
    $department = $res[0]['department_id'];
    if($school == 0 && $department == 0) {
      $continue = 'setup1';
    }
    return $continue;
  }

  function setupConf() {
    $check = firstLoginConfirm();
    switch ($check) {
      case 'setup1':
        header('Location: /practicumhub/home/setup');
        break;

      case 'setup2':
        header('Location: /practicumhub/home/setupdept');
        break;

      default:
        break;
    }
  }

  function searchSchoolWithKey($data) {
    $val = 0;
    $conn = dbconn();
    $sql = "SELECT p.partner_id, p.partner_key, s.partner_id, s.school_id
            FROM partners p INNER JOIN schools s ON p.partner_id = s.partner_id
            WHERE partner_key = ?";
    $pdo = $conn->prepare($sql);
    $pdo->execute($data);
    $res = $pdo->fetchAll();
    $conn = null;
    if(count($res)>0) {
      $val = $res[0]['school_id'];
    }
    return $val;
  }

  function confirmSchool($data) {
    $school_id = searchSchoolWithKey(array($data[0]));
    if($school_id != 0) {
      $data2 = array($school_id, $data[1]);
      $conn = dbconn();
      $sql = "UPDATE students SET school_id = ? WHERE acct_no = ?";
      $pdo = $conn->prepare($sql);
      $update = $pdo->execute($data2);
      $conn = null;
      if($update) {
        header('Location: /practicumhub/home/setupdept');
      }
      else {
        die("Error confirming the school.");
      }
    }
    else {
      header('Location: /practicumhub/home/setupschool?errmsg=school_not_found');
    }
  }

  function confirmDept($data) {
    $conn = dbconn();
    $sql = "UPDATE students SET department_id = ? WHERE acct_no = ?";
    $pdo = $conn->prepare($sql);
    $update = $pdo->execute($data);
    $conn = null;
    if($update) {
      header('Location: /practicumhub/home');
    }
    else {
      die("Error confirming the department.");
    }
  }

  function getActiveDept() {
    $conn = dbconn();
    $sql = "SELECT d.department_id di, d.department_name, d.school_id,
            s.department_id, s.acct_no, s.school_id FROM departments d
            INNER JOIN students s ON s.school_id = d.school_id
            WHERE s.acct_no = ?";
    $pdo = $conn->prepare($sql);
    $pdo->execute(array($_SESSION['ACCT_NO']));
    $res = $pdo->fetchAll();
    $conn = null;
    return $res;
  }

  function confirmEnrollmentKey($data) {
    $val = [];
    $conn = dbconn();
    // $sql = "SELECT s.acct_no, s.department_id, a.adviser_id, a.department_id,
    //         a.acct_no, c.adviser_id, c.class_id, c.enrollment_key, c.status, d.department_id, d.school_id
    //         FROM students s INNER JOIN practicum_advisers a
    //         ON s.department_id = a.department_id
    //         INNER JOIN classes c ON a.acct_no = c.adviser_id 
    //         INNER JOIN departments d ON a.department_id = d.department_id
    //         WHERE s.acct_no = ? AND c.enrollment_key = ? AND c.status = 'ACTIVE'";
    $sql = "SELECT c.class_id, c.enrollment_key, c.status, a.acct_no, 
            a.department_id, d.department_id, d.school_id 
            FROM classes c INNER JOIN practicum_advisers a ON c.adviser_id = a.acct_no 
            INNER JOIN departments d ON a.department_id = d.department_id 
            WHERE c.enrollment_key = ? AND c.status = 'ACTIVE'";
    $pdo = $conn->prepare($sql);
    $pdo->execute(array($data));
    $res = $pdo->fetchAll();
    $conn = null;
    if(count($res)>0) {
      $val = array(
        $res[0]['school_id'],
        $res[0]['department_id'],
        $res[0]['class_id'],
        $_SESSION['ACCT_NO']
      );
    }
    return $val;
  }

  function enrollClass($data) {
    $class_id = confirmEnrollmentKey($data);
    if(count($class_id)>0) {
      $conn = dbconn();
      $sql = "UPDATE students SET school_id = ?, department_id = ?, class_id = ? WHERE acct_no = ?";
      $pdo = $conn->prepare($sql);
      $update = $pdo->execute($class_id);
      $conn = null;
      if($update) {
        header('Location: /practicumhub/home/manageclass');
      }
      else {
        die("Error enrollment.");
      }
    }
    else {
      header('Location: /practicumhub/home/setup?errmsg=class_not_found');
    }
  }

  function getMyEnrolledClass() {
    $conn = dbconn();
    $sql = "SELECT s.acct_no, s.class_id, c.class_id, c.program_id, c.adviser_id,
            c.class_description, c.class_time_sched, c.class_day_sched, c.status,
            ua.acct_no, ua.firstname, ua.middlename, ua.lastname, p.program_id,
            p.program_title, p.semester, p.school_year, p.startdate, p.enddate,
            p.no_of_hours, p.department_id
            FROM students s INNER JOIN classes c
            ON s.class_id = c.class_id INNER JOIN user_account ua
            ON c.adviser_id = ua.acct_no INNER JOIN practicum_programs p
            ON c.program_id = p.program_id WHERE s.acct_no = ?";
    $pdo = $conn->prepare($sql);
    $pdo->execute(array($_SESSION['ACCT_NO']));
    $res = $pdo->fetchAll();
    $conn = null;
    return $res;
  }

  function getMyProgress() {
    $conn = dbconn();
    $sql = "SELECT s.class_id, s.acct_no, s.hours_done, c.class_id, c.program_id,
            p.program_id, p.no_of_hours FROM students s
            INNER JOIN classes c ON s.class_id = c.class_id
            INNER JOIN practicum_programs p ON c.program_id = p.program_id
            WHERE s.acct_no = ? LIMIT 1";
    $pdo = $conn->prepare($sql);
    $pdo->execute(array($_SESSION['ACCT_NO']));
    // $pdo->execute(array($data));
    $res = $pdo->fetchAll();
    $conn = null;
    return $res;
  }

?>
