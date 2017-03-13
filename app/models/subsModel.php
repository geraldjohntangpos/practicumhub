<?php

  function addSubcription($data) {
    $enddate = computeEndDate($data[2], $data[3]);
    $data[3] = $enddate;

    $conn = dbconn();
    $sql = "INSERT INTO subscription_plans (acct_no, keygen, startdate, enddate, description)
            VALUES(?, ?, ?, ?, ?)";
    $pdo = $conn->prepare($sql);
    $ins = $pdo->execute($data);
    $conn = null;
    if($ins) {
      header('Location: /practicumhub/home/managesubs');
    }
    else {
      die("Error Adding.");
    }
  }

  function addSubcriptionTrainer($data, $postcount) {
    $enddate = computeEndDate($data[2], $data[3]);
    $data[3] = $enddate;

    $conn = dbconn();
    $sql = "INSERT INTO subscription_plans (acct_no, keygen, startdate, enddate, description)
            VALUES(?, ?, ?, ?, ?)";
    $pdo = $conn->prepare($sql);
    $ins = $pdo->execute($data);
    $conn = null;
    if($ins) {
      addNewPostLeft(array($data[1], $postcount));
    }
    else {
      die("Error Adding.");
    }
  }

  function addNewPostLeft($data) {
    $data[0] = getSubPlanNo(array($data[0]));
    $conn = dbconn();
    $sql = "INSERT INTO postleft(subplan_no, count) VALUES(?, ?)";
    $pdo = $conn->prepare($sql);
    $ins = $pdo->execute($data);
    $conn = null;
    if($ins) {
      header('Location: /practicumhub/home/managesubs');
    }
    else {
      die("Error adding post left.");
    }
  }

  function getSubPlanNo($data) {
    $conn = dbconn();
    $sql = "SELECT subplan_no FROM subscription_plans WHERE keygen = ?";
    $pdo = $conn->prepare($sql);
    $pdo->execute($data);
    $res = $pdo->fetchAll();
    $conn = null;
    return $res[0]['subplan_no'];
  }

  function getPostLeft($data) {
    $conn = dbconn();
    $sql = "SELECT * FROM postleft WHERE subplan_no = ?";
    $pdo = $conn->prepare($sql);
    $pdo->execute($data);
    $res = $pdo->fetchAll();
    $conn = null;
    return $res[0]['count'];
  }

  function getAllPostLeft($data) {
    $totalcount = 0;
    $conn = dbconn();
    $sql = "SELECT s.subplan_no, s.acct_no, s.sub_status, p.subplan_no, p.count FROM subscription_plans s 
            INNER JOIN postleft p ON s.subplan_no = p.subplan_no WHERE s.sub_status = 'ACTIVE' AND s.acct_no = ?";
    $pdo = $conn->prepare($sql);
    $pdo->execute($data);
    $res = $pdo->fetchAll();
    $conn = null;
    if(count($res)>0) {
      foreach($res as $row) {
        $totalcount += $row['count'];
      }
    }
    return $totalcount;
  }

  function computeEndDate($date, $months) {
    $arrMonth = ["January", "February", "March", "April", "May",
                  "June", "July", "August", "September", "October",
                  "November", "December"];
    $monthnum;
    $originalMonth;
    // $month = substr($date, strpos($date, ' ')+1, strpos($date, ',')-1);

    for($i = 0; $i < 12; $i++) {
      if(strpos($date, $arrMonth[$i])) {
        $monthnum = $i;
        $originalMonth = $arrMonth[$i];
      }
    }

    $monthnum += $months;
    if($monthnum > 11)
      $monthnum -= 12;

    return str_replace($originalMonth, $arrMonth[$monthnum], $date);
  }

  function retrieveMySubs($data) {
    $conn = dbconn();
    $sql = "SELECT * FROM subscription_plans WHERE acct_no = ? AND sub_status = 'ACTIVE'";
    $pdo = $conn->prepare($sql);
    $pdo->execute($data);
    $res = $pdo->fetchAll();
    $conn = null;

    return $res;
  }

  function retrieveOneSub($data) {
    $conn = dbconn();
    $sql = "SELECT * FROM subscription_plans WHERE subplan_no = ?";
    $pdo = $conn->prepare($sql);
    $pdo->execute($data);
    $res = $pdo->fetchAll();
    $conn = null;

    return $res;
  }

  function updateSub($data) {
    $conn = dbconn();
    $sql = "UPDATE subscription_plans SET description = ? WHERE subplan_no = ?";
    $pdo = $conn->prepare($sql);
    $update = $pdo->execute($data);
    $conn = null;

    if($update) {
      header('Location: /practicumhub/home/managesubs');
    }
    else {
      die("Error updating subscription.");
    }
  }

  function deleteSubs($data) {
    $conn = dbconn();
    $sql = "UPDATE subscription_plans SET sub_status = 'TERMINATED' WHERE subplan_no = ?";
    $pdo = $conn->prepare($sql);
    $del = $pdo->execute($data);
    $conn = null;

    if($del) {
      header('Location: /practicumhub/home/managesubs');
    }
    else {
      die('Error deleting subscription.');
    }
  }

  function getHeadCount() {
    $conn = dbconn();
    $sql = "SELECT d.school_id, d.acct_no, s.acct_no, s.school_id 
            FROM dept_admins d INNER JOIN students s ON d.school_id = s.school_id
            WHERE d.acct_no = ?";
    $pdo = $conn->prepare($sql);
    $pdo->execute(array($_SESSION['ACCT_NO']));
    $res = $pdo->fetchAll();
    $counter = 0;
    if(count($res)>0) {
      foreach ($res as $row) {
        $counter++;
      }
    }
    return $counter;
  }

  function computeHeadCount($data) {
    $conn = dbconn();
    $sql = "SELECT d.school_id, d.acct_no, s.acct_no, s.school_id 
            FROM dept_admins d INNER JOIN students s ON d.school_id = s.school_id
            WHERE d.acct_no = ?";
    $pdo = $conn->prepare($sql);
    $pdo->execute($data);
    $res = $pdo->fetchAll();
    $counter = 0;
    if(count($res)>0) {
      foreach ($res as $row) {
        $counter++;
      }
    }
    return $counter*5.00 . " Pesos";
  }

?>
