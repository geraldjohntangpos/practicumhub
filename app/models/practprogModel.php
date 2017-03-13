<?php

  function getMyDeptId() {
    $conn = dbconn();
    $sql = "SELECT department_id FROM dept_admins WHERE acct_no = ? LIMIT 1";
    $pdo = $conn->prepare($sql);
    $pdo->execute(array($_SESSION['ACCT_NO']));
    $res = $pdo->fetchAll();
    return $res[0]['department_id'];
    // return json_encode($res);
  }

  function addProg($data) {
    $department_id = getMyDeptId();
    $data[] = $department_id;
    $conn = dbconn();
    $sql = "INSERT INTO practicum_programs
            (program_title, program_description, semester, school_year, startdate, enddate, no_of_hours, department_id)
            VALUES(?, ?, ?, ?, ?, ?, ?, ?)";
    $pdo = $conn->prepare($sql);
    $ins = $pdo->execute($data);
    $conn = null;

    if($ins) {
      header('Location: /practicumhub/home/manageprog');
    }
    else {
      die("Error adding program.");
    }
  }

  function ourProg() {
    $conn = dbconn();
    // $sql = "SELECT da.department_id, da.dept_admin_id,
    //         a.department_id, a.adviser_id, a.acct_no,
    //         p.program_id, p.program_title, p.status, p.department_id,
    //         d.department_id, d.department_name
    //         FROM dept_admin da INNER JOIN practicum_advisers a
    //         ON da.department_id = a.department_id
    //         INNER JOIN departments d ON d.department_id = da.department_id
    //         INNER JOIN practicum_programs p ON p.department_id = d.department_id
    //         WHERE a.acct_no = ?";
    $sql = "SELECT p.program_id, p.program_title, p.department_id,
            a.adviser_id, a.department_id, a.acct_no
            FROM practicum_advisers a INNER JOIN practicum_programs p
            ON p.department_id = a.department_id
            WHERE a.acct_no = ?";
    $pdo = $conn->prepare($sql);
    $pdo->execute(array($_SESSION['ACCT_NO']));
    $res = $pdo->fetchAll();
    $conn = null;
    return $res;
  }

  function retAllMyActiveProg() {
    $data = array(getMyDeptId());
    $conn = dbconn();
    $sql = "SELECT * FROM practicum_programs WHERE department_id = ? AND status = 'ACTIVE'";
    $pdo = $conn->prepare($sql);
    $pdo->execute($data);
    $res = $pdo->fetchAll();
    $conn = null;

    return $res;
  }

  function retrieveOneProg($data) {
    $conn = dbconn();
    $sql = "SELECT * FROM practicum_programs WHERE status = 'ACTIVE' AND program_id = ?";
    $pdo = $conn->prepare($sql);
    $pdo->execute($data);
    $ret = $pdo->fetchAll();
    $conn = null;

    return $ret;
  }

  function updateProg($data) {
    $conn = dbconn();
    $sql = "UPDATE practicum_programs SET
            program_title = ?, program_description = ?, semester = ?,
            school_year = ?, startdate = ?, enddate = ?,
            no_of_hours = ? WHERE program_id = ?";
    $pdo = $conn->prepare($sql);
    $update = $pdo->execute($data);
    $conn = null;

    if($update) {
      header('Location: /practicumhub/home/manageprog');
    }
    else {
      die("Error updating program.");
    }
  }

  function deleteProg($data) {
    $conn = dbconn();
    $sql = "UPDATE practicum_programs SET status = 'DELETED' WHERE program_id = ?";
    $pdo = $conn->prepare($sql);
    $del = $pdo->execute($data);
    $conn = null;

    if($del) {
      header('Location: /practicumhub/home/manageprog');
    }
    else {
      die("Error deleting program.");
    }
  }

  function getAllActiveProg() {
    $conn = dbconn();
    $sql = "SELECT * FROM practicum_programs WHERE status = 'ACTIVE'";
  }

?>
