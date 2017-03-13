<?php

  function getMyDtr() {
    $conn = dbconn();
    $sql = "SELECT d.dtr_id, d.intern_id, d.diary, d.time_in, d.time_out, d.dtr_status,
            s.student_id, s.acct_no, i.intern_id, i.student_id
            FROM dtr d INNER JOIN interns i
            ON d.intern_id = i.intern_id
            INNER JOIN students s ON i.student_id = s.acct_no
            WHERE s.acct_no = ? ORDER BY d.dtr_id DESC";
    $pdo = $conn->prepare($sql);
    $pdo->execute(array($_SESSION['ACCT_NO']));
    $res = $pdo->fetchAll();
    $conn = null;
    return $res;
  }

  function getMyDtr2($data) {
    $conn = dbconn();
    $sql = "SELECT d.dtr_id, d.intern_id, d.diary, d.time_in, d.time_out, d.dtr_status,
            s.student_id, s.acct_no, i.intern_id, i.student_id
            FROM dtr d INNER JOIN interns i
            ON d.intern_id = i.intern_id
            INNER JOIN students s ON i.student_id = s.acct_no
            WHERE s.acct_no = ? ORDER BY d.dtr_id DESC";
    $pdo = $conn->prepare($sql);
    $pdo->execute($data);
    $res = $pdo->fetchAll();
    $conn = null;
    return $res;
  }

  function countTimeIn() {
    $command = 'stop';
    $months = ["January", "February", "March",
                "April", "May", "June", "July",
                "August", "September", "October",
                "November", "December"];
    $lastIn = getMyDtr()[0]['time_in'];
    $time_in = splitDateTime($lastIn);
    $time_now = dateNowWithTime();
    $runtime = $time_in;
    $monthNow = array_search($time_now['month'], $months)+1;
    $monthRun = array_search($runtime['month'], $months)+1;
    $days = 0;
    $minutes = 0;
    while($runtime['year']<$time_now['year'] || $monthRun<$monthNow || $runtime['date']<$time_now['date']) {
      $daycount = date("t", mktime(0, 0, 0, $monthRun, 1, $runtime['year']));
      $runtime['date']++;
      if($runtime['date'] > $daycount) {
        $monthRun++;
        if($monthRun>12) {
          $runtime['year']++;
          $monthRun = 1;
        }
        $runtime['date'] = 1;
      }
      $days++;
      // die("Hahaha");
    }
    if($days>1) {
      forceDtrOut($time_in);
    }
    else {
      $runtime = $time_in;
      $hourRun = $runtime['hour'];
      $hourNow = $time_now['hour'];
      if($runtime['meridiem'] == "PM") {
        $hourRun = $hourRun + 12;
        if($hourRun == 24)
          $hourRun = 0;
      }
      if($time_now['meridiem'] == "PM") {
        $hourNow = $hourNow + 12;
        if($hourNow == 24)
          $hourNow = 0;
      }
      while($runtime['date']<$time_now['date'] || $hourRun<$hourNow || $runtime['minutes']<$time_now['minutes']) {
        $runtime['minutes']++;
        if($runtime['minutes']>59) {
          $hourRun++;
          if($hourRun>23) {
            $hourRun = 0;
            $runtime['date']++;
          }
          $runtime['minutes'] = 0;
        }
        $minutes++;
      }
      // die("Over minutes" .$minutes);
      if($minutes > 720) {
        forceDtrOut($time_in);
      }
      else {
        $command = 'continue';
      }
    }
    return $command;
  }

  function forceDtrOut($t) {
    $time = $t;
    if($time['meridiem'] == "AM") {
      $time['meridiem'] = "PM";
    }
    else {
      $time['meridiem'] = "AM";
      $time['date']++;
      $time['date'] = makeItTwoChar($time['date']);
    }
    $time_out = concatDateWithTime2($time);
    $dtr_id = getMyDtr()[0]['dtr_id'];
    logoutDtr(array($time_out, $dtr_id));
  }

  function checkMyLastLogin() {
    $status = 'out';
    $myDtr = getMyDtr();
    if(count($myDtr)>0) {
      $last = $myDtr[0]['time_out'];
      if($last == "") {
        $command = countTimeIn();
        if($command == 'stop') {
          $status = 'in';
        }
      }
      else {
        $status = 'in';
      }
    }
    else {
      $status = 'in';
    }
    return $status;
  }

  function getMyInternId() {
    $conn = dbconn();
    $sql = "SELECT * FROM interns WHERE student_id = ?";
    $pdo = $conn->prepare($sql);
    $pdo->execute(array($_SESSION['ACCT_NO']));
    $intern_id = $pdo->fetchAll();
    $conn = null;
    return $intern_id[0]['intern_id'];
  }

  function loginDtr($data) {
    $conn = dbconn();
    $sql = "INSERT INTO dtr(intern_id, time_in)
            VALUES(?, ?)";
    $pdo = $conn->prepare($sql);
    $login = $pdo->execute($data);
    $conn = null;
    if($login) {
      header('Location: /practicumhub/home/managedtr');
    }
    else {
      header('Location: /practicumhub/home/managedtr?errmsg=errordtrlogin');
    }
  }

  function logoutDtr($data) {
    $conn = dbconn();
    $sql = "UPDATE dtr SET time_out = ?, dtr_status = 'PENDING' WHERE dtr_id = ?";
    $pdo = $conn->prepare($sql);
    $logout = $pdo->execute($data);
    $conn = null;
    if($logout) {
      header('Location: /practicumhub/home/managedtr');
    }
    else {
      header('Location: /practicumhub/home/managedtr?errmsg=errordtrlogout');
    }
  }

?>
