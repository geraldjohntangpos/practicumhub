<?php

  function deptadminInfo($data) {
    $conn = dbconn();
    $sql = "SELECT * FROM dept_admins WHERE acct_no = ?";
    $pdo = $conn->prepare($sql);
    $pdo->execute($data);
    $res = $pdo->fetchAll();
    $conn = null;

    return $res;
  }

  function promoteSchoolAdmin($data) {
    $conn = dbconn();
    $sql = "UPDATE user_account SET type = 'department admin/School admin' WHERE acct_no = ?";
    $pdo = $conn->prepare($sql);
    $update = $pdo->execute($data);
    $conn = null;

    if($update) {
      header('Location: /practicumhub/home/manageschool');
    }
    else {
      die("Error promoting as School Admin");
    }
  }

?>
