<?php

  if(isset($_POST['addprog'])) {
    $progtitle = $_POST['progtitle'];
    $description = $_POST['description'];
    $semester = $_POST['semester'];
    $schoolyear = $_POST['schoolyear'];
    $startdate = $_POST['startdate'];
    $enddate = $_POST['enddate'];
    $reqhours = $_POST['reqhours'];
    $acctno = $_SESSION['ACCT_NO'];

    $data = array($progtitle, $description,
                  $semester, $schoolyear, $startdate,
                  $enddate, $reqhours);
    addProg($data);
  }

?>

<div class="fixed-action-btn" style="bottom: 45px; right: 24px;">
  <a class="btn-floating btn-large #9a8989" href="/practicumhub/home/manageprog">
    <i class="large material-icons">clear</i>
  </a>
</div>
<div class="signin row container">
  <form class="col s12" method="post">
    <h4 class="center brown-text">Add Practicum Program</h4>
    <div class="row">
      <div class="input-field col s12">
        <input id="progtitle" type="text" name="progtitle" value="" required>
        <label for="progtitle">Program Title</label>
      </div>
      <div class="input-field col s12">
        <select name="semester" required>
          <option value="" disabled selected>Choose Semester</option>
          <option value="1st">1st</option>
          <option value="2nd">2nd</option>
        </select>
        <label>Semester</label>
      </div>
      <div class="input-field col s12">
        <input id="schoolyear" type="text" name="schoolyear" value="<?php echo "S.Y. " .date("Y"). " - " .(date("Y")+1); ?>" required readonly>
        <label for="schoolyear">School Year</label>
      </div>
      <div class="input-field col s12">
        <input id="startdate" type="date" class="datepicker" name="startdate" required>
        <label for="startdate">Start Date</label>
      </div>
      <div class="input-field col s12">
        <input id="enddate" type="date" class="datepicker" name="enddate" required>
        <label for="enddate">End Date</label>
      </div>
      <div class="input-field col s12">
        <input id="reqhours" type="number" name="reqhours" required>
        <label for="reqhours">Required Hours</label>
      </div>
      <div class="row">
        <div class="input-field col s12">
          <textarea id="description" class="materialize-textarea" name="description" length="255"></textarea>
          <label for="description">Description</label>
        </div>
      </div>
      <div class="right">
        <input class="btn" type="submit" value="Add Program" name="addprog">
      </div>
    </div>
  </form>
</div>
