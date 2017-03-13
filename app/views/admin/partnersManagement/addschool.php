<?php

  if(isset($_POST['addschool'])) {
    $schoolname = $_POST['schoolname'];
    $schoolcampus = $_POST['schoolcampus'];
    $schooladdress = $_POST['schooladdress'];
    $contactno = $_POST['contactno'];
    $partnerkey = $_POST['partnerkey'];

    $data = array($schoolname, $schoolcampus, $schooladdress, $contactno);

    addSchool($data, $partnerkey);
  }

?>

<div class="fixed-action-btn" style="bottom: 45px; right: 24px;">
  <a class="btn-floating btn-large #9a8989" href="/practicumhub/home/managepartners">
    <i class="large material-icons">clear</i>
  </a>
</div>
<div class="signin row container">
  <form class="col s12" method="post">
    <h4 class="center brown-text">Add Partner School</h4>
    <div class="row">
      <div class="input-field col s12">
        <i class="material-icons prefix">vpn_key</i>
        <input id="partnerkey" type="text" name="partnerkey" value="<?php pr(generateKeyGen(15)); ?>" required readonly>
        <label for="partnerkey">Partner Key</label>
      </div>
      <div class="input-field col s12">
        <input id="schoolname" type="text" name="schoolname" value="" required>
        <label for="schoolname">School Name</label>
      </div>
      <div class="input-field col s12">
        <input id="schoolcampus" type="text" name="schoolcampus" value="" required>
        <label for="schoolcampus">School Campus</label>
      </div>
      <div class="input-field col s12">
        <input id="schooladdress" type="text" name="schooladdress" value="" required>
        <label for="schooladdress">School Address</label>
      </div>
      <div class="input-field col s12">
        <input id="contactno" type="text" name="contactno" value="" required>
        <label for="contactno">Contact Number</label>
      </div>
      <div class="right">
        <input class="btn" type="submit" value="Add School" name="addschool">
      </div>
    </div>
  </form>
</div>
