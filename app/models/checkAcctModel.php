<?php
  //the purpose of this model is to check the details of the accounts.

  //this function check the type of the accounts
  //whether it is an admin, a student, trainner and etc.
  function checkAcctType($data) {
    $conn = dbconn();
    $sql = "SELECT type FROM user_account WHERE acct_no = ?";
    $pdo = $conn->prepare($sql);
    $pdo->execute($data);
    $res = $pdo->fetchAll();
    $conn = null;

    if(count($res)>0) {
      foreach ($res as $row) {
        $type = $row['type'];
      }
    }

    return $type;
  }

  //this function sets the session with and index of ACCT_NO
  //the session is a global variable which runs within the browser
  //and will only be unset if you destroy or unset it and if
  //you close your browser.
  function setSession($data) {
      $_SESSION['ACCT_NO'] = $data[0];
      $_SESSION['ACCT_TYPE'] = checkAcctType($data);
  }

  function getAcctFullname($data) {
    $conn = dbconn();
    $sql = "SELECT * FROM user_account WHERE acct_no = ?";
    $pdo = $conn->prepare($sql);
    $pdo->execute($data);
    $res = $pdo->fetchAll();
    $conn = null;

    if(count($res)>0) {
      foreach ($res as $row) {
        $name = $row['firstname'];
      }
    }
    return $name;
  }

  function getAcctInfo($data) {
    $conn = dbconn();
    $sql = "SELECT * FROM user_account WHERE acct_no = ?";
    $pdo = $conn->prepare($sql);
    $pdo->execute($data);
    $res = $pdo->fetchAll();
    $conn = null;

    return $res;
  }

?>
