<?php

  function retrieveMyDept() {
    $conn = dbconn();
    $sql = "SELECT * FROM dept_admins WHERE acct_no = ?";
    $pdo = $conn->prepare($sql);
    $pdo->execute(array($_SESSION['ACCT_NO']));
    $res = $pdo->fetchAll();
    $conn = null;

    return $res;
  }

  function retrieveMyDeptAdviser() {
    $conn = dbconn();
    $sql = "SELECT * FROM practicum_advisers WHERE acct_no = ?";
    $pdo = $conn->prepare($sql);
    $pdo->execute(array($_SESSION['ACCT_NO']));
    $res = $pdo->fetchAll();
    $conn = null;

    return $res;
  }

  function retrieveDept() {
    $conn = dbconn();
    $sql = "SELECT da.acct_no, da.department_id, d.department_key, d.department_id,
              d.department_name, d.department_dean, d.contact_no
            FROM dept_admins da INNER JOIN departments d
            ON da.department_id = d.department_id
            WHERE da.acct_no = ?";
    $pdo = $conn->prepare($sql);
    $pdo->execute(array($_SESSION['ACCT_NO']));
    $res = $pdo->fetchAll();
    $conn = null;

    return $res;
  }

  function retrieveAdviserDept() {
    $conn = dbconn();
    $sql = "SELECT pa.acct_no, pa.department_id, d.department_key, d.department_id,
              d.department_name, d.department_dean, d.contact_no
            FROM practicum_advisers pa INNER JOIN departments d
            ON pa.department_id = d.department_id
            WHERE pa.acct_no = ?";
    $pdo = $conn->prepare($sql);
    $pdo->execute(array($_SESSION['ACCT_NO']));
    $res = $pdo->fetchAll();
    $conn = null;

    return $res;
  }

  function addNewDept($data) {
    $data[] = mySchoolId();
    $conn = dbconn();
    $sql = "INSERT INTO departments(department_key, department_name, department_dean, contact_no, school_id)
            VALUES(?, ?, ?, ?, ?)";
    $pdo = $conn->prepare($sql);
    $add = $pdo->execute($data);
    $conn = null;
    if($add) {
      attachDept(array($data[0]));
    }
    else {
      die("Error adding new department.");
    }
  }

  function getLastDeptId($data) {
    $conn = dbconn();
    $sql = "SELECT department_id FROM departments WHERE department_key = ? LIMIT 1";
    $pdo = $conn->prepare($sql);
    $pdo->execute($data);
    $res = $pdo->fetchAll();
    $conn = null;
    return $res[0]['department_id'];
  }

  function attachDept($data) {
    $department_id = getLastDeptId($data);
    $data = array($department_id, $_SESSION['ACCT_NO']);
    $conn = dbconn();
    $sql = "UPDATE dept_admins SET department_id = ? WHERE acct_no = ?";
    $pdo = $conn->prepare($sql);
    $update = $pdo->execute($data);
    $conn = null;
    if($update) {
      header('Location: /practicumhub/home/manageschool');
    }
    else {
      die("Error attaching department.");
    }
  }

  function confirmDeptKey($data) {
    $cont = false;
    $conn = dbconn();
    $sql = "SELECT * FROM departments
            WHERE department_id = ? AND department_key = ? LIMIT 1";
    $pdo = $conn->prepare($sql);
    $pdo->execute($data);
    $res = $pdo->fetchAll();
    $conn = null;
    if(count($res)>0) {
      $cont = true;
    }
    return $cont;
  }

  function adviserJoinDept($data) {
    $cont = confirmDeptKey($data);
    if($cont) {
      $conn = dbconn();
      $sql = "UPDATE practicum_advisers SET department_id = ? WHERE acct_no = ?";
      $pdo = $conn->prepare($sql);
      $update = $pdo->execute(array($data[0], $_SESSION['ACCT_NO']));
      $conn = null;
      if($update) {
        header('Location: /practicumhub/home/manageschool');
      }
      else {
        die("Error joining of adviser.");
      }
    }
  }

  function retrieveSchoolActiveDept() {
    $conn = dbconn();
    $sql = "SELECT d.department_id, d.department_key, d.school_id,
            d.department_name, d.department_dean, d.contact_no,
            s.school_id, s.school_name
            FROM departments d INNER JOIN schools s
            ON d.school_id = s.school_id
            WHERE d.school_id = ?";
    $pdo = $conn->prepare($sql);
    $pdo->execute(array(mySchoolIdAdviser()));
    $res = $pdo->fetchAll();
    $conn = null;
    return $res;
  }

?>
