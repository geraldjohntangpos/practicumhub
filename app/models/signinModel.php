<?php

  //this function is for signin.
  function signin($data) {
    $conn = dbconn();
    $sql = "SELECT * FROM user_account WHERE username = ? AND password = ?";
    $pdo = $conn->prepare($sql);
    $pdo->execute($data);
    $res = $pdo->fetchAll();
    $conn = null;
    if(count($res)>0) {
      foreach ($res as $row) {
        $acct_no = $row['acct_no'];
      }
      setSession(array($acct_no));
      header('Location: /practicumhub/home/'. $acct_no);
    }
    else {
      header('Location: /practicumhub/signin?errmsg=invalidlogin');
    }
  }

?>
