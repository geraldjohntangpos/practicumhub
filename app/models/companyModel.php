<?php

  function getMyCompany() {
    $conn = dbconn();
    $sql = "SELECT c.company_id, c.partner_id, c.company_name, c.company_branch,
            c.company_address, c.company_contact, c.image, t.acct_no, t.company_id,
            p.partner_id, p.partner_key, p.partner_type, p.partner_dateadded
            FROM companies c INNER JOIN trainers t ON c.company_id = t.company_id
            INNER JOIN partners p ON c.partner_id = p.partner_id
            WHERE t.acct_no = ? LIMIT 1";
    $pdo = $conn->prepare($sql);
    $pdo->execute(array($_SESSION['ACCT_NO']));
    $res = $pdo->fetchAll();
    $conn = null;
    return $res;
  }

  function addCompany($data, $partnerkey) {
    $continue = addPartner(array($partnerkey, "company", myDateNow()));
    if($continue) {
      $data[] = lastInsertedPartner(array($partnerkey));
      $conn = dbconn();
      $sql = "INSERT INTO companies(company_name, company_branch, company_address, company_contact, partner_id)
      VALUES(?, ?, ?, ?, ?)";
      $pdo = $conn->prepare($sql);
      $ins = $pdo->execute($data);
      $conn = dbconn();

      if($ins) {
        attachComp(array($partnerkey));
      }
      else {
        die("Error adding company.");
      }
    }
    else {
      die("Error adding partner.");
    }
  }

  function lastCompId($data) {
    $conn = dbconn();
    $sql = "SELECT p.partner_id, p.partner_key, c.company_id, c.partner_id
            FROM partners p INNER JOIN companies c ON p.partner_id = c.partner_id
            WHERE p.partner_key = ?";
    $pdo = $conn->prepare($sql);
    $pdo->execute($data);
    $res = $pdo->fetchAll();
    $conn = null;

    return $res[0]['company_id'];
  }

  function attachComp($data) {
    $company_id = lastCompId($data);
    $conn = dbconn();
    $sql = "UPDATE trainers SET company_id = ? WHERE acct_no = ?";
    $pdo = $conn->prepare($sql);
    $attach = $pdo->execute(array($company_id, $_SESSION['ACCT_NO']));
    $conn = null;
    if($attach) {
      header('Location: /practicumhub/home');
    }
    else {
      die('Error attaching the company.');
    }
  }

?>
