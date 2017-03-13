<?php

  if(isset($_POST['addnewdept'])) {
    $department_name = $_POST['deptname'];
    $department_dean = $_POST['deptdean'];
    $contact_no = $_POST['deptcontact'];
    $department_key = $_POST['department_key'];

    $data = array($department_key, $department_name, $department_dean, $contact_no);
    addNewDept($data);
  }

?>

<div class="fixed-action-btn" style="bottom: 45px; right: 24px;">
  <a class="btn-floating btn-large #9a8989" href="/practicumhub/home/manageprog">
    <i class="large material-icons">clear</i>
  </a>
</div>
<div class="signin row container">
  <form class="col s12" method="post">
    <h4 class="center brown-text">Add New Department</h4>
    <div class="row">
      <div class="input-field col s12">
        <i class="material-icons prefix">vpn_key</i>
        <input id="department_key" type="text" name="department_key" value="<?php pr(generateKeyGen(15)); ?>" required readonly>
        <label for="department_key">Department Key</label>
      </div>
      <div class="input-field col s12">
        <input id="deptname" type="text" name="deptname" value="" required>
        <label for="deptname">Department Name</label>
      </div>
      <div class="input-field col s12">
        <input id="deptdean" type="text" name="deptdean" value="" required>
        <label for="deptdean">Department Dean</label>
      </div>
      <div class="input-field col s12">
        <input id="deptcontact" type="text" name="deptcontact" value="" required>
        <label for="deptcontact">Department Contact</label>
      </div>
      <div class="right">
        <input class="btn" type="submit" value="Add Department" name="addnewdept">
      </div>
    </div>
  </form>
</div>
