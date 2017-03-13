<?php

  if(isset($_POST['updateschool'])) {
    $partnerid = $_POST['partnerid'];
    $schoolname = $_POST['schoolname'];
    $schoolcampus = $_POST['schoolcampus'];
    $schooladdress = $_POST['schooladdress'];
    $contactno = $_POST['contactno'];

    $data = array($schoolname, $schoolcampus, $schooladdress, $contactno, $partnerid);

    updateSchool($data);
  }

?>

<div class="fixed-action-btn" style="bottom: 45px; right: 24px;">
  <a class="btn-floating btn-large #9a8989" href="/practicumhub/home/managepartners">
    <i class="large material-icons">clear</i>
  </a>
</div>
<div class="signin row container">
  <form class="col s12" method="post">
    <h4 class="center brown-text">Update Partner School</h4>
    <div class="row">
      <div class="input-field col s12">
        <input id="partnerid" type="number" name="partnerid" value="<?php pr($baseurl[3]); ?>" required readonly>
        <label for="partnerid">Partner ID</label>
      </div>
      <div class="input-field col s12">
        <input id="schoolname" type="text" name="schoolname" value="<?php pr($school_name); ?>" required>
        <label for="schoolname">School Name</label>
      </div>
      <div class="input-field col s12">
        <input id="schoolcampus" type="text" name="schoolcampus" value="<?php pr($school_campus); ?>" required>
        <label for="schoolcampus">School Campus</label>
      </div>
      <div class="input-field col s12">
        <input id="schooladdress" type="text" name="schooladdress" value="<?php pr($school_address); ?>" required>
        <label for="schooladdress">School Address</label>
      </div>
      <div class="input-field col s12">
        <input id="contactno" type="text" name="contactno" value="<?php pr($contact_no); ?>" required>
        <label for="contactno">Contact Number</label>
      </div>
      <div class="right">
        <input class="btn" type="submit" value="Update School" name="updateschool">
      </div>
    </div>
  </form>
</div>
