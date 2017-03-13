<?php

  if(isset($_POST['addclass'])) {
    // die('Hala.');
    $program_id = $_POST['program_id'];
    $adviser_id = $_SESSION['ACCT_NO'];
    $description = $_POST['description'];
    $enrollmentkey = $_POST['enrollmentkey'];
    $timesched = $_POST['timefrom']. " - " .$_POST['timeuntil'];
    $d = $_POST['day'];
    $day = convdays($d);

    // var_dump($d);

    $data = array($program_id, $adviser_id, $description, $enrollmentkey, $timesched, $day);

    addClass($data);
  }

?>

<div class="fixed-action-btn" style="bottom: 45px; right: 24px;">
  <a class="btn-floating btn-large #9a8989" href="/practicumhub/home/manageclass">
    <i class="large material-icons">clear</i>
  </a>
</div>
<div class="signin row container">
  <form class="col s12" method="post">
    <h4 class="center brown-text">Add New Class</h4>
    <div class="row">
      <div class="input-field col s12">
        <i class="material-icons prefix">vpn_key</i>
        <input id="enrollmentkey" type="text" value="<?php pr(generateKeyGen(8)); ?>" name="enrollmentkey" required readonly>
        <label for="enrollmentkey">Enrollment Key</label>
      </div>
      <div class="input-field col s12">
        <select name="program_id">
          <option value="" disabled selected>Choose Program</option>
          <?php
            $ourProg = ourProg();
            if(count($ourProg)>0) {
              foreach ($ourProg as $row) {
                $program_id = $row['program_id'];
                $program_title = $row['program_title'];
                ?>
                  <option value="<?php pr($program_id); ?>"><?php pr($program_title); ?></option>
                <?php
              }
            }
            else {
              ?>
                <option value="" disabled>None</option>
              <?php
            }
          ?>
        </select>
        <label>Program</label>
      </div>
      <div class="col s12">
        <p>Select Time Schedule</p>
      </div>
      <div class="input-field col s5">
        <input type="time" name="timefrom" value="" id="from" required>
        <!-- <select class="" name="timefrom" id="timefrom">
          <option value="" disabled selected>---Select---</option>
          <?php
            for ($i=1; $i < 24; $i++) {
              for($j = 0; $j < 31; $j+=30) {
                $time = timeconv($i, $j);
                ?>
                <option value="<?php echo $time; ?>"><?php echo $time; ?></option>
                <?php
              }
            }
          ?>
        </select>
        <label>From</label> -->
      </div>
      <div class="col s2">
        <h3 class="center">-</h3>
      </div>
      <div class="input-field col s5">
        <input type="time" name="timeuntil" value="" id="until" required>
      </div>
      <div class="col s12">
        <p>Select Day Schedule</p>
        <p>
          <input type="checkbox" name="day[]" value="Sunday" id="sunday">
          <label for="sunday">Sunday</label>
        </p>
        <p>
          <input type="checkbox" name="day[]" value="Monday" id="monday">
          <label for="monday">Monday</label>
        </p>
        <p>
          <input type="checkbox" name="day[]" value="Tuesday" id="tuesday">
          <label for="tuesday">Tuesday</label>
        </p>
        <p>
          <input type="checkbox" name="day[]" value="Wednesday" id="wednesday">
          <label for="wednesday">Wednesday</label>
        </p>
        <p>
          <input type="checkbox" name="day[]" value="Thursday" id="thursday">
          <label for="thursday">Thursday</label>
        </p>
        <p>
          <input type="checkbox" name="day[]" value="Friday" id="friday">
          <label for="friday">Friday</label>
        </p>
        <p>
          <input type="checkbox" name="day[]" value="Saturday" id="saturday">
          <label for="saturday">Saturday</label>
        </p>
      </div>
      <div class="row">
        <div class="input-field col s12">
          <textarea id="description" class="materialize-textarea" name="description" length="255" required></textarea>
          <label for="description">Class Description</label>
        </div>
      </div>
      <div class="right">
        <input class="btn" type="submit" value="Add Class" name="addclass">
      </div>
    </div>
  </form>
</div>
