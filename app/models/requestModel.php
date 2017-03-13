<?php

  function getJobRequest($data) {
    $conn = dbconn();
    $sql = "SELECT r.request_id, r.job_id, r.student_id,
            r.request_status, s.acct_no, s.school_id, sc.school_id, sc.school_name, 
            a.firstname, a.middlename, a.lastname, a.acct_no
            FROM requests r INNER JOIN students s ON r.student_id = s.acct_no
            INNER JOIN user_account a ON s.acct_no = a.acct_no 
            INNER JOIN schools sc ON s.school_id = sc.school_id
            WHERE r.job_id = ? AND r.request_status = 'PENDING'";
    $pdo = $conn->prepare($sql);
    $pdo->execute($data);
    $res = $pdo->fetchAll();
    $conn = null;
    return $res;
  }

  function getMyRequestOnJob($data) {
    $conn = dbconn();
    $sql = "SELECT * FROM requests WHERE job_id = ? AND student_id = ?
            AND request_status = 'PENDING' LIMIT 1";
    $pdo = $conn->prepare($sql);
    $pdo->execute($data);
    $res = $pdo->fetchAll();
    $conn = null;
    return $res;
  }

  function addRequest($data) {
    $conn = dbconn();
    $sql = "INSERT INTO requests(job_id, student_id)
            VALUES(?, ?)";
    $pdo = $conn->prepare($sql);
    $add = $pdo->execute($data);
    $conn = null;
    if($add) {
      header('Location: /practicumhub/home/viewjobs');
    }
    else {
      header('Location: /practicumhub/home/viewjobs?errmsg=requestfailed');
    }
  }

  function delReq($data) {
    $conn = dbconn();
    $sql = "UPDATE requests SET request_status = 'CANCELED' WHERE request_id = ?";
    $pdo = $conn->prepare($sql);
    $up = $pdo->execute($data);
    $conn = null;
    if($up) {
      header('Location: /practicumhub/home/viewjobs');
    }
    else {
      header('Location: /practicumhub/home/viewjobs?errmsg=requestcancel_failed');
    }
  }

  function declineReq($data) {
    $conn = dbconn();
    $sql = "UPDATE requests SET request_status = 'DECLINED' WHERE request_id = ?";
    $pdo = $conn->prepare($sql);
    $up = $pdo->execute($data);
    $conn = null;
    if($up) {
      header('Location: /practicumhub/home/managejobs');
    }
    else {
      header('Location: /practicumhub/home/viewjobs?errmsg=requestcancel_failed');
    }
  }

  function gaga() {
    $conn = dbconn();
    $sql = "SELECT * FROM user_account";
    $pdo = $conn->prepare($sql);
    $pdo->execute();
    $res = $pdo->fetchAll();
    $conn = null;
    return $res;
  }

?>
