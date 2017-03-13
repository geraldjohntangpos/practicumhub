<?php

  function retrieveAllMyClass() {
    $conn = dbconn();
    $sql = "SELECT c.class_id, c.program_id, c.adviser_id,
            c.class_description, c.enrollment_key, c.class_time_sched,
            c.class_day_sched, p.program_id, p.program_title,
            p.program_description, p.semester, p.school_year,
            p.startdate, p.enddate, p.no_of_hours, p.status, p.department_id,
            a.adviser_id, a.school_id, a.department_id, a.acct_no,
            ua.acct_no, ua.firstname, ua.middlename, ua.lastname
            FROM classes c INNER JOIN practicum_programs p
            ON c.program_id = p.program_id INNER JOIN practicum_advisers a
            ON c.adviser_id = a.acct_no INNER JOIN user_account ua
            ON a.acct_no = ua.acct_no WHERE c.status = 'ACTIVE'
            AND ua.acct_no = ?";
    $pdo = $conn->prepare($sql);
    $pdo->execute(array($_SESSION['ACCT_NO']));
    $ret = $pdo->fetchAll();
    $conn = null;

    return $ret;
  }

  function addClass($data) {
    $conn = dbconn();
    $sql = "INSERT INTO classes(program_id, adviser_id, class_description,
            enrollment_key, class_time_sched, class_day_sched)
            VALUES (?, ?, ?, ?, ?, ?)";
    $pdo = $conn->prepare($sql);
    $ins = $pdo->execute($data);
    $conn = null;

    if($ins) {
      header('Location: /practicumhub/home/manageclass');
    }
    else {
      die("Error adding class.");
    }
  }

  function getStudentsEnrolled($data) {
    $conn = dbconn();
    $sql = "SELECT s.student_id, s.school_id, s.department_id, s.class_id,
            s.acct_no, a.acct_no, a.firstname, a.middlename, a.lastname
            FROM students s INNER JOIN user_account a
            ON s.acct_no = a.acct_no WHERE s.class_id = ?";
    $pdo = $conn->prepare($sql);
    $pdo->execute($data);
    $res = $pdo->fetchAll();
    $conn = null;
    return $res;
  }



?>
