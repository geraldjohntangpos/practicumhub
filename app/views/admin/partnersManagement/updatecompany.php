<?php

  if(isset($_POST['updatecompany'])) {
    $partnerid = $_POST['partnerid'];
    $companyname = $_POST['companyname'];
    $companybranch = $_POST['companybranch'];
    $companyaddress = $_POST['companyaddress'];
    $companycontact = $_POST['companycontact'];

    $data = array($companyname, $companybranch, $companyaddress, $companycontact, $partnerid);

    updateCompany($data);
  }

?>

<div class="fixed-action-btn" style="bottom: 45px; right: 24px;">
  <a class="btn-floating btn-large #9a8989" href="/practicumhub/home/managepartners">
    <i class="large material-icons">clear</i>
  </a>
</div>
<div class="signin row container">
  <form class="col s12" method="post">
    <h4 class="center brown-text">Add Partner Company</h4>
    <div class="row">
      <div class="input-field col s12">
        <input id="partnerid" type="text" name="partnerid" value="<?php pr($baseurl[3]); ?>" required readonly>
        <label for="partnerid">Partner ID</label>
      </div>
      <div class="input-field col s12">
        <input id="companyname" type="text" name="companyname" value="<?php pr($company_name); ?>" required>
        <label for="companyname">Company Name</label>
      </div>
      <div class="input-field col s12">
        <input id="companybranch" type="text" name="companybranch" value="<?php pr($company_branch); ?>" required>
        <label for="companybranch">Company Branch</label>
      </div>
      <div class="input-field col s12">
        <input id="companyaddress" type="text" name="companyaddress" value="<?php pr($company_address); ?>" required>
        <label for="companyaddress">Company Address</label>
      </div>
      <div class="input-field col s12">
        <input id="companycontact" type="text" name="companycontact" value="<?php pr($company_contact); ?>" required>
        <label for="companycontact">Contact Number</label>
      </div>
      <div class="right">
        <input class="btn" type="submit" value="Update Company" name="updatecompany">
      </div>
    </div>
  </form>
</div>
