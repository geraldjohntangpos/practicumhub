<?php

  function updateBasic($data) {
    $conn = dbconn();
    $sql = "UPDATE user_account SET firstname = ?, middlename = ?, lastname = ?,
            address = ?, date_of_birth = ?, gender = ?, contactno = ?, emailadd = ?
            WHERE acct_no = ?";
    $pdo = $conn->prepare($sql);
    $update = $pdo->execute($data);
    $conn = null;

    if($update) {
      header('Location: /practicumhub/home');
    }
    else {
      die("Error updating admin profile.");
    }
  }

?>
