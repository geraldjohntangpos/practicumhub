<?php

  function getAllMyInterns() {
    $conn = dbconn();
    $sql = "SELECT i.intern_id, i.trainer_id, i.student_id, i.hiredate, i.position,
            a.acct_no, a.firstname, a.middlename, a.lastname, s.acct_no, s.hours_done,
            s.class_id, c.class_id, c.program_id, p.program_id, p.no_of_hours
            FROM interns i INNER JOIN user_account a ON i.student_id = a.acct_no
            INNER JOIN students s ON i.student_id = s.acct_no
            INNER JOIN classes c ON s.class_id = c.class_id
            INNER JOIN practicum_programs p ON c.program_id = p.program_id
            WHERE i.trainer_id = ?";
    $pdo = $conn->prepare($sql);
    $pdo->execute(array($_SESSION['ACCT_NO']));
    $res = $pdo->fetchAll();
    $conn = null;
    return $res;
  }

  function getMyOneIntern($data) {
    $data[] = $_SESSION['ACCT_NO'];
    $conn = dbconn();
    $sql = "SELECT i.intern_id, i.trainer_id, i.student_id, i.hiredate, i.position,
            a.acct_no, a.firstname, a.middlename, a.lastname, a.address, a.date_of_birth,
            a.gender, a.contactno, a.emailadd, a.image, s.acct_no, s.hours_done,
            s.class_id, c.class_id, c.program_id, p.program_id, p.no_of_hours
            FROM interns i INNER JOIN user_account a ON i.student_id = a.acct_no
            INNER JOIN students s ON i.student_id = s.acct_no
            INNER JOIN classes c ON s.class_id = c.class_id
            INNER JOIN practicum_programs p ON c.program_id = p.program_id
            WHERE i.intern_id = ? AND i.trainer_id = ?";
    $pdo = $conn->prepare($sql);
    $pdo->execute($data);
    $res = $pdo->fetchAll();
    $conn = null;
    return $res;
  }

  function getInternPendingDtr($data) {
    $conn = dbconn();
    $sql = "SELECT * FROM dtr WHERE intern_id = ? AND dtr_status = 'PENDING'";
    $pdo = $conn->prepare($sql);
    $pdo->execute($data);
    $res = $pdo->fetchAll();
    $conn = null;
    return $res;
  }

  function getInternRecordedDtr($data) {
    $conn = dbconn();
    $sql = "SELECT * FROM dtr WHERE intern_id = ? AND dtr_status = 'RECORDED'
            ORDER BY dtr_id DESC";
    $pdo = $conn->prepare($sql);
    $pdo->execute($data);
    $res = $pdo->fetchAll();
    $conn = null;
    return $res;
  }

  function getInternDtr($data) {
    $conn = dbconn();
    $sql = "SELECT * FROM dtr WHERE intern_id = ? AND dtr_status != 'PENDING'";
    $pdo = $conn->prepare($sql);
    $pdo->execute($data);
    $res = $pdo->fetchAll();
    $conn = null;
    return $res;
  }

  function declinePending($data, $intern_id) {
    $conn = dbconn();
    $sql = "UPDATE dtr SET dtr_status = 'DECLINED' WHERE dtr_id = ?";
    $pdo = $conn->prepare($sql);
    $decline = $pdo->execute($data);
    $conn = null;
    if($decline) {
      header('Location: /practicumhub/home/viewinterndtr/' .$intern_id);
    }
    else {
      header('Location: /practicumhub/home/viewinterndtr/' .$intern_id. '?errmsg=errordeclinedtr');
    }
  }

  function getInternStudId($data) {
    $conn = dbconn();
    $sql = "SELECT student_id FROM interns WHERE intern_id = ?";
    $pdo = $conn->prepare($sql);
    $pdo->execute($data);
    $id = $pdo->fetchAll();
    $conn = null;
    return $id[0]['student_id'];
  }

  function recordPending($data, $intern_id, $dtr_id) {
    $conn = dbconn();
    $sql = "UPDATE students SET hours_done = hours_done + ? WHERE acct_no = ?";
    $pdo = $conn->prepare($sql);
    $accept = $pdo->execute($data);
    $conn = null;
    if($accept) {
      recordDtr(array($dtr_id), $intern_id);
    }
    else {
      header('Location: /practicumhub/home/viewinterndtr/' .$intern_id. '?errmsg=errorrecordpending');
    }
  }

  function recordDtr($data, $intern_id) {
    $conn = dbconn();
    $sql = "UPDATE dtr SET dtr_status = 'RECORDED' WHERE dtr_id = ?";
    $pdo = $conn->prepare($sql);
    $update = $pdo->execute($data);
    $conn = null;
    if($update) {
      header('Location: /practicumhub/home/viewinterndtr/' .$intern_id);
    }
    else {
      header('Location: /practicumhub/home/viewinterndtr/' .$intern_id. '?errmsg=errordtrrecord');
    }
  }

  function editDiary($data) {
    $conn = dbconn();
    $sql = "UPDATE dtr SET diary = ? WHERE dtr_id = ?";
    $pdo = $conn->prepare($sql);
    $update = $pdo->execute($data);
    $conn = null;
    if($update) {
      header('Location: /practicumhub/home/managedtr');
    }
    else {
      header('Location: /practicumhub/home/managedtr?errmsg=diaryerror');
    }
  }

  // function acceptRequest($data) {
  //   $conn = dbconn();
  //   $sql = "SELECT r.request_id, r.job_id, r.department_id, r.slots_number, r.request_status,
  //           j.job_id, j.slots_available FROM requests r INNER JOIN jobs j ON r.job_id = j.job_id
  //           WHERE r.request_id = ? LIMIT 1";
  //   $pdo = $conn->prepare($sql);
  //   $pdo->execute($data);
  //   $result = $pdo->fetchAll();
  //   $conn = null;
  //   $res = [
  //       $result[0]['request_id'],
  //       $result[0]['job_id'],
  //       $result[0]['department_id'],
  //       $result[0]['slots_number'],
  //       $result[0]['request_status']
  //   ];
  //   if($result[0]['slots_available']<$result[0]['slots_number']) {
  //     $res[3] = $result['slots_available'];
  //   }
  //   getJoblessStudsInADept($res);
  // }

  function acceptRequest($data, $job_id, $request_id) {
    $conn = dbconn();
    $sql = "INSERT INTO interns (trainer_id, student_id, hiredate)
            VALUES(?, ?, ?)";
    $pdo = $conn->prepare($sql);
    $ins = $pdo->execute($data);
    $conn = null;
    if($ins) {
      confirmRequest($request_id, $job_id);
    }
    else {
      die("Error accepting application.");
    }
  }

  function getJoblessStudsInADept($data) {
    $conn = dbconn();
    $sql = "SELECT s.student_id, s.school_id, s.department_id, s.class_id, s.acct_no,
            i.intern_id, i.trainer_id, i.student_id
            FROM students s LEFT JOIN interns i ON i.student_id = s.acct_no
            WHERE s.department_id = ? AND i.student_id is NULL";
    $pdo = $conn->prepare($sql);
    $pdo->execute(array($data[2]));
    $result = $pdo->fetchAll();
    $conn = null;
    $counter = 0;
    while($counter < $data[3]) {
      $res = [
        $_SESSION['ACCT_NO'],
        $result[$counter]['acct_no'],
        concatDateWithTime()
      ];
      addNewIntern($res, $data[1]);
      $counter++;
    }
    confirmRequest(array($data[0]));
  }

  function confirmRequest($data, $job_id) {
    $conn = dbconn();
    $sql = "UPDATE requests SET request_status = 'ACCEPTED' WHERE request_id = ?";
    $pdo = $conn->prepare($sql);
    $update = $pdo->execute($data);
    $conn = null;
    if($update) {
      subtractSlotsAvailable($job_id);
    }
    else {
      die("Error accepting the request");
    }
  }

  function addNewIntern($data, $job_id) {
    $conn = dbconn();
    $sql = "INSERT INTO interns(trainer_id, student_id, hiredate) VALUES(?, ?, ?)";
    $pdo = $conn->prepare($sql);
    $ins = $pdo->execute($data);
    $conn = null;
    if($ins) {
      subtractSlotsAvailable(array($job_id));
    }
    else {
      die("Error in adding an intern.");
    }
  }

  function subtractSlotsAvailable($data) {
    $conn = dbconn();
    $sql = "UPDATE jobs SET slots_available = slots_available - 1 WHERE job_id = ?";
    $pdo = $conn->prepare($sql);
    $update = $pdo->execute($data);
    $conn = null;
    if($update) {
      header('Location: /practicumhub/home/managejobs');
    }
    else {
      header('Location: /practicumhub/home/managejobs?errmsg=errpo');
    }
  }

?>
