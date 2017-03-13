<?php

  //this function is used to get the last inputted id in the user_account
  //table which will be needed in the account holder in some tables.
  function getLastAcctNo($data) {
    $conn = dbconn();
    $sql = "SELECT * FROM user_account WHERE username = ?";
    $pdo = $conn->prepare($sql);
    $pdo->execute($data);
    $res = $pdo->fetchAll();
    $conn = null;

    if(count($res)>0) {
      foreach ($res as $row) {
        $acct_no = $row['acct_no'];
      }
    }

    return $acct_no;
  }

  //this function is used to add the user acct.
  function addUserAcct($data) {
    $conn = dbconn();
    $sql = "INSERT INTO user_account(username, password, firstname, middlename,
            lastname, address, date_of_birth, gender, contactno, emailadd, type)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $pdo = $conn->prepare($sql);
    $ins = $pdo->execute($data);
    $conn = null;
    if($ins) {
      return getLastAcctNo(array($data[0]));
    }
    else {
      die("Error adding user account.");
    }
  }

  //this function will add a student
  function addStudent($data) {
    $conn = dbconn();
    $sql = "INSERT INTO students(acct_no) VALUES (?)";
    $pdo = $conn->prepare($sql);
    $ins = $pdo->execute($data);
    $conn = null;
    if($ins) {
      setSession($data);
      header('Location: /practicumhub/home/'. $data[0]);
    }
    else {
      die("Error adding student.");
    }
  }

  //this function is used to add a Trainer.
  function addTrainer($data) {
    $conn = dbconn();
    $sql = "INSERT INTO trainers(acct_no) VALUES (?)";
    $pdo = $conn->prepare($sql);
    $ins = $pdo->execute($data);
    $conn = null;
    if($ins) {
      setSession($data);
      header('Location: /practicumhub/home/'. $data[0]);
    }
    else {
      die("Error adding trainer.");
    }
  }

  //to add an Adviser.
  function addAdviser($data) {
    $conn = dbconn();
    $sql = "INSERT INTO practicum_advisers(acct_no) VALUES (?)";
    $pdo = $conn->prepare($sql);
    $ins = $pdo->execute($data);
    $conn = null;
    if($ins) {
      setSession($data);
      header('Location: /practicumhub/home/'. $data[0]);
    }
    else {
      die("Error adding Adviser.");
    }
  }

  //to add a department Admin.
  function addDeptAdmin($data) {
    $conn = dbconn();
    $sql = "INSERT INTO dept_admins(acct_no) VALUES (?)";
    $pdo = $conn->prepare($sql);
    $ins = $pdo->execute($data);
    $conn = null;
    if($ins) {
      setSession($data);
      header('Location: /practicumhub/home/'. $data[0]);
    }
    else {
      die("Error adding dept admin.");
    }
  }

  //this is the function for the registration of students,
  //trainer and adviser.
  function basicRegistration($data) {
    $lastid = addUserAcct($data);
    switch ($data[10]) {
      case 'student':
        addStudent(array($lastid));
        break;

      case 'trainer':
        addTrainer(array($lastid));
        break;

      case 'adviser':
        addAdviser(array($lastid));
        break;

      case 'department admin':
        addDeptAdmin(array($lastid));
        break;
    }
  }

?>
