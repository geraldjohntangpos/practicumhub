<?php

  if(isset($_POST['enroll'])) {
    $enrollmentkey = $_POST['enrollmentkey'];
    $acct_no = $_SESSION['ACCT_NO'];

    $data = $enrollmentkey;
    enrollClass($data);
  }

?>

<div class="signin row container">
  <form class="col s12" method="post">
    <h4 class="center brown-text">Enroll to Class</h4>
    <div class="row">
      <div class="input-field col s12">
        <i class="material-icons prefix">vpn_key</i>
        <input id="enrollmentkey" type="text" name="enrollmentkey" autofocus required>
        <label for="enrollmentkey">Enrollment Key</label>
      </div>
      <div class="col s12">
        <input class="btn col s12" type="submit" value="Enroll Class" name="enroll">
      </div>
    </div>
  </form>
</div>
