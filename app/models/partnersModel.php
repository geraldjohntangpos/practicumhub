<?php

  function retAllActivePartners() {
    $partners = [];
    $singledata = [];
    $partnerinfo;
    $conn = dbconn();
    $sql = "SELECT * FROM partners WHERE partner_status = 'ACTIVE'";
    $pdo = $conn->prepare($sql);
    $pdo->execute();
    $ret = $pdo->fetchAll();
    $conn = null;

    if(count($ret)>0) {
      foreach($ret as $row) {
        if($row['partner_type'] == 'school') {
          $partnerinfo = retSchool(array($row['partner_id']));
          foreach ($partnerinfo as $k) {
            $school_id = $k['school_id'];
            $school_name = $k['school_name'];
            $school_campus = $k['school_campus'];
            $school_address = $k['school_address'];
            $contact_no = $k['contact_no'];
            $school_image = $k['school_image'];
          }
          $singledata = [
            'partner_id' => $row['partner_id'],
            'partner_key' => $row['partner_key'],
            'partner_type' => $row['partner_type'],
            'partner_status' => $row['partner_status'],
            'partner_dateadded' => $row['partner_dateadded'],
            'school_id' => $school_id,
            'school_name' => $school_name,
            'school_campus' => $school_campus,
            'school_address' => $school_address,
            'contact_no' => $contact_no,
            'school_image' => $school_image
          ];
        }
        else {
          $partnerinfo = retCompany(array($row['partner_id']));
          foreach ($partnerinfo as $k) {
            $company_id = $k['company_id'];
            $company_name = $k['company_name'];
            $company_branch = $k['company_branch'];
            $company_address = $k['company_address'];
            $company_contact = $k['company_contact'];
            $image = $k['image'];
          }
          $singledata = [
            'partner_id' => $row['partner_id'],
            'partner_key' => $row['partner_key'],
            'partner_type' => $row['partner_type'],
            'partner_status' => $row['partner_status'],
            'partner_dateadded' => $row['partner_dateadded'],
            'company_id' => $company_id,
            'company_name' => $company_name,
            'company_branch' => $company_branch,
            'company_address' => $company_address,
            'company_contact' => $company_contact,
            'image' => $image
          ];
        }
        $partners[] = $singledata;
      }
    }

    return $partners;
  }

  function retSchool($data) {
    $conn = dbconn();
    $sql = "SELECT * FROM schools WHERE partner_id = ? LIMIT 1";
    $pdo = $conn->prepare($sql);
    $pdo->execute($data);
    $result = $pdo->fetchAll();
    foreach($result as $row) {
      $ret[] = [
        'school_id' => $row['school_id'],
        'school_name' => $row['school_name'],
        'school_campus' => $row['school_campus'],
        'school_address' => $row['school_address'],
        'contact_no' => $row['contact_no'],
        'school_image' => $row['school_image']
      ];
    }
    return $ret;
  }

  function retCompany($data) {
    $conn = dbconn();
    $sql = "SELECT * FROM companies WHERE partner_id = ? LIMIT 1";
    $pdo = $conn->prepare($sql);
    $pdo->execute($data);
    $result = $pdo->fetchAll();
    foreach($result as $row) {
      $ret[] = [
        'company_id' => $row['company_id'],
        'company_name' => $row['company_name'],
        'company_branch' => $row['company_branch'],
        'company_address' => $row['company_address'],
        'company_contact' => $row['company_contact'],
        'image' => $row['image']
      ];
    }
    return $ret;
  }

  function addPartner($data) {
    $bool = false;
    $conn = dbconn();
    $sql = "INSERT INTO partners(partner_key, partner_type, partner_dateadded)
            VALUES(?, ?, ?)";
    $pdo = $conn->prepare($sql);
    $ins = $pdo->execute($data);
    $conn = null;

    if($ins) {
      $bool = true;
    }

    return $bool;
  }

  function lastInsertedPartner($data) {
    $conn = dbconn();
    $sql = "SELECT * FROM partners WHERE partner_key = ?";
    $pdo = $conn->prepare($sql);
    $pdo->execute($data);
    $result = $pdo->fetchAll();
    $conn = null;
    foreach ($result as $row) {
      $partner_id = $row['partner_id'];
    }
    return $partner_id;
  }

  function getASchool($data) {
    $conn = dbconn();
    $sql = "SELECT * FROM schools WHERE partner_id = ?";
    $pdo = $conn->prepare($sql);
    $pdo->execute($data);
    $res = $pdo->fetchAll();
    $conn = null;

    return $res;
  }

  function getACompany($data) {
    $conn = dbconn();
    $sql = "SELECT * FROM companies WHERE partner_id = ?";
    $pdo = $conn->prepare($sql);
    $pdo->execute($data);
    $res = $pdo->fetchAll();
    $conn = null;

    return $res;
  }

  function updateSchool($data) {
    $conn = dbconn();
    $sql = "UPDATE schools SET school_name = ?, school_campus = ?, school_address = ?,
            contact_no = ? WHERE partner_id = ?";
    $pdo = $conn->prepare($sql);
    $update = $pdo->execute($data);
    $conn = null;

    if($update) {
      header('Location: /practicumhub/home/managepartners');
    }
    else {
      die("Error updating school.");
    }
  }

  function updateCompany($data) {
    $conn = dbconn();
    $sql = "UPDATE companies SET company_name = ?, company_branch = ?, company_address = ?,
            company_contact = ? WHERE partner_id = ?";
    $pdo = $conn->prepare($sql);
    $update = $pdo->execute($data);
    $conn = null;

    if($update) {
      header('Location: /practicumhub/home/managepartners');
    }
    else {
      die("Error updating company.");
    }
  }

  function searchPartner($data) {
    $bool = false;
    $conn = dbconn();
    $sql = "SELECT * FROM partners WHERE partner_id = ?";
    $pdo = $conn->prepare($sql);
    $pdo->execute($data);
    $res = $pdo->fetchAll();
    $conn = null;

    if(count($res)>0) {
      $bool = true;
    }

    return $bool;
  }

  function deletePartner($data) {
    $cont = searchPartner($data);
    if($cont) {
      $conn = dbconn();
      $sql = "UPDATE partners SET partner_status = 'DELETED' WHERE partner_id = ?";
      $pdo = $conn->prepare($sql);
      $del = $pdo->execute($data);
      $conn = null;

      if($del) {
        header('Location: /practicumhub/home/managepartners');
      }
      else {
        die("Error deleting partner.");
      }
    }
    else {
      incError();
    }
  }

  function viewSchoolLanding() {
    $conn = dbconn();
    $sql = "SELECT p.partner_id, p.partner_type, p.partner_status, s.partner_id, s.school_name, 
            s.school_image FROM partners p INNER JOIN schools s ON p.partner_id = s.partner_id 
            WHERE p.partner_type = 'school' AND p.partner_status = 'ACTIVE'";
    $pdo = $conn->prepare($sql);
    $pdo->execute();
    $res = $pdo->fetchAll();
    $conn = null;
    return $res;
  }

  function viewCompanyLanding() {
    $conn = dbconn();
    $sql = "SELECT p.partner_id, p.partner_type, p.partner_status, c.partner_id, c.company_name, 
            c.image FROM partners p INNER JOIN companies c ON p.partner_id = c.partner_id 
            WHERE p.partner_type = 'company' AND p.partner_status = 'ACTIVE'";
    $pdo = $conn->prepare($sql);
    $pdo->execute();
    $res = $pdo->fetchAll();
    $conn = null;
    return $res;
  }

?>
