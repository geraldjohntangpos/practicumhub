<?php

  function getAllSubPlans() {
    $conn = dbconn();
    $sql = "SELECT * FROM subscription_plans sp INNER JOIN user_account ua
            ON sp.acct_no = ua.acct_no";
    $pdo = $conn->prepare($sql);
    $pdo->execute();
    $res = $pdo->fetchAll();
    $conn = null;

    return $res;
  }

?>
