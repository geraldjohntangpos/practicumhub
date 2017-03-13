<?php

  if(isset($_POST['addcompany'])) {
    $companyname = $_POST['companyname'];
    $companybranch = $_POST['companybranch'];
    $companyaddress = $_POST['companyaddress'];
    $companycontact = $_POST['companycontact'];
    $partnerkey = $_POST['partnerkey'];

    $data = array($companyname, $companybranch, $companyaddress, $companycontact);

    addCompany($data, $partnerkey);
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
        <i class="material-icons prefix">vpn_key</i>
        <input id="partnerkey" type="text" name="partnerkey" value="<?php pr(generateKeyGen(15)); ?>" required readonly>
        <label for="partnerkey">Partner Key</label>
      </div>
      <div class="input-field col s12">
        <input id="companyname" type="text" name="companyname" value="" required>
        <label for="companyname">Company Name</label>
      </div>
      <div class="input-field col s12">
        <input id="companybranch" type="text" name="companybranch" value="" required>
        <label for="companybranch">Company Branch</label>
      </div>
      <div class="input-field col s12">
        <input id="companyaddress" type="text" name="companyaddress" value="" required>
        <label for="companyaddress">Company Address</label>
      </div>
      <div class="input-field col s12">
        <input id="companycontact" type="text" name="companycontact" value="" required>
        <label for="companycontact">Contact Number</label>
      </div>
      <div class="right">
        <input class="btn" type="submit" value="Add Company" name="addcompany">
      </div>
    </div>
  </form>
</div>
