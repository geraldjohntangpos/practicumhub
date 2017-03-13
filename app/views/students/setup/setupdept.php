<?php

  if(isset($_POST['finish'])) {
    $department_id = $_POST['department_id'];
    $acct_no = $_SESSION['ACCT_NO'];

    $data = array($department_id, $acct_no);
    confirmDept($data);
  }

?>

<div class="signin row container">
  <form class="col s12" method="post">
    <h4 class="center brown-text">SETUP DEPARTMENT</h4>
    <div class="row">
      <div class="input-field col s12">
        <div class="input-field col s12">
          <select name="department_id" required>
            <option value="" disabled selected>Choose Department</option>
            <?php
              $departments = getActiveDept();
              if(count($departments)>0) {
                foreach ($departments as $row) {
                  $department_id = $row['di'];
                  $department_name = $row['department_name'];
                  ?>
                  <option value="<?php pr($department_id); ?>"><?php pr($department_name); ?></option>
                  <?php
                }
              }
            ?>
          </select>
        </div>
        <!-- <input id="dept_key" type="text" class="validate" name="dept_key" required>
        <label for="dept_key">Department Key</label> -->
      </div>
      <div class="col s12">
        <input class="btn col s12" type="submit" value="FINISH" name="finish">
      </div>
    </div>
  </form>
</div>
