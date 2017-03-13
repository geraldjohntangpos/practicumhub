<?php

  function getMyActivePost() {
    $conn = dbconn();
    $sql = "SELECT * FROM jobs WHERE acct_no = ? AND slots_available != 0
            ORDER BY job_id DESC";
    $pdo = $conn->prepare($sql);
    $pdo->execute(array($_SESSION['ACCT_NO']));
    $res = $pdo->fetchAll();
    $conn = null;
    return $res;
  }

  function postJob($data) {
    $conn = dbconn();
    $sql = "INSERT INTO jobs(job_desc, slots_available, date_posted, acct_no)
            VALUES(?, ?, ?, ?)";
    $pdo = $conn->prepare($sql);
    $post = $pdo->execute($data);
    $conn = null;
    if($post) {
      subtractPostLeft();
    }
    else {
      header('Location: /practicumhub/home/managejobs?errmsg=post_err');
    }
  }

  function getMyFirstActiveSubs() {
    $conn = dbconn();
    $sql = "SELECT s.subplan_no, s.acct_no, s.sub_status, p.subplan_no, p.count, p.postleft_id 
            FROM subscription_plans s INNER JOIN postleft p ON s.subplan_no = p.subplan_no 
            WHERE p.count != 0 AND s.sub_status = 'ACTIVE' AND s.acct_no = ? LIMIT 1";
    $pdo = $conn->prepare($sql);
    $pdo->execute(array($_SESSION['ACCT_NO']));
    $res = $pdo->fetchAll();
    return $res [0]['postleft_id'];
  }

  function subtractPostLeft() {
    $postleft_id = getMyFirstActiveSubs();
    $conn = dbconn();
    $sql = "UPDATE postleft SET count = count-1 WHERE postleft_id = ?";
    $pdo = $conn->prepare($sql);
    $update = $pdo->execute(array($postleft_id));
    if($update) {
      header('Location: /practicumhub/home/managejobs');
    }
    else {
      die("Error subtracting post count left.");
    }
  }

  function getAllJobs() {
    $conn = dbconn();
    $sql = "SELECT j.job_id, j.job_desc, j.slots_available, j.date_posted, j.acct_no,
            t.trainer_id, t.company_id, t.acct_no, a.acct_no, a.firstname, a.middlename,
            a.lastname, a.image, c.company_id, c.company_name, c.company_branch,
            c.company_address, c.company_contact
            FROM jobs j INNER JOIN trainers t ON j.acct_no = t.acct_no
            INNER JOIN user_account a ON t.acct_no = a.acct_no
            INNER JOIN companies c ON t.company_id = c.company_id ORDER BY j.job_id DESC";
    $pdo = $conn->prepare($sql);
    $pdo->execute();
    $res = $pdo->fetchAll();
    $conn = null;
    return $res;
  }

?>
