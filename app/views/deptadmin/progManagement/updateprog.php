<?php

  if(isset($_POST['updateprog'])) {
    $progtitle = $_POST['progtitle'];
    $description = $_POST['description'];
    $semester = $_POST['semester'];
    $schoolyear = $_POST['schoolyear'];
    $startdate = $_POST['startdate'];
    $enddate = $_POST['enddate'];
    $reqhours = $_POST['reqhours'];
    $progid = $_POST['progid'];

    $data = array($progtitle, $description,
                  $semester, $schoolyear, $startdate,
                  $enddate, $reqhours, $progid);
    updateProg($data);
  }

?>

<div class="fixed-action-btn" style="bottom: 45px; right: 24px;">
  <a class="btn-floating btn-large #9a8989" href="/practicumhub/home/manageprog">
    <i class="large material-icons">clear</i>
  </a>
</div>
<div class="signin row container">
  <form class="col s12" method="post">
    <h4 class="center brown-text">Update Practicum Program</h4>
    <div class="row">
      <div class="input-field col s12">
        <input id="progid" type="number" name="progid" value="<?php pr($program_id); ?>" required readonly>
        <label for="progid">Program ID</label>
      </div>
      <div class="input-field col s12">
        <input id="progtitle" type="text" name="progtitle" value="<?php pr($program_title); ?>" required>
        <label for="progtitle">Program Title</label>
      </div>
      <div class="input-field col s12">
        <select name="semester" required>
          <option value="" disabled selected>Choose Semester</option>
          <option value="1st"
            <?php
              if($semester == "1st")
                pr("selected");
            ?>
          >1st</option>
          <option value="2nd"
            <?php
              if($semester == "2nd")
                pr("selected");
            ?>
          >2nd</option>
        </select>
        <label>Semester</label>
      </div>
      <div class="input-field col s12">
        <input id="schoolyear" type="text" name="schoolyear" value="<?php pr($school_year); ?>" required readonly>
        <label for="schoolyear">School Year</label>
      </div>
      <div class="input-field col s12">
        <input id="startdate" type="date" class="datepicker" value="<?php pr($startdate); ?>" name="startdate" required>
        <label for="startdate">Start Date</label>
      </div>
      <div class="input-field col s12">
        <input id="enddate" type="date" class="datepicker" value="<?php pr($enddate); ?>" name="enddate" required>
        <label for="enddate">End Date</label>
      </div>
      <div class="input-field col s12">
        <input id="reqhours" type="number" name="reqhours" value="<?php pr($no_of_hours); ?>" required>
        <label for="reqhours">Required Hours</label>
      </div>
      <div class="row">
        <div class="input-field col s12">
          <textarea id="description" class="materialize-textarea" name="description" length="255"><?php pr($program_description); ?></textarea>
          <label for="description">Description</label>
        </div>
      </div>
      <div class="right">
        <input class="btn" type="submit" value="Update Program" name="updateprog">
      </div>
    </div>
  </form>
</div>
