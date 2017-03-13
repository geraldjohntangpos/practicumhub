<?php

  if(isset($_POST['enroll'])) {
    $enrollmentkey = $_POST['enrollmentkey'];

    $data = $enrollmentkey;
    enrollClass($data);
  }

  $myClass = getMyEnrolledClass();
  if(count($myClass)>0) {
    $class_id = $myClass[0]['class_id'];
    $program_title = $myClass[0]['program_title'];
    $class_description = $myClass[0]['class_description'];
    $timesched = $myClass[0]['class_time_sched'];
    $daysched = $myClass[0]['class_day_sched'];
    $firstname = $myClass[0]['firstname'];
    $middlename = $myClass[0]['middlename'];
    $lastname = $myClass[0]['lastname'];
    $semester = $myClass[0]['semester'];
    $school_year = $myClass[0]['school_year'];
    $startdate = $myClass[0]['startdate'];
    $enddate = $myClass[0]['enddate'];
    $no_of_hours = $myClass[0]['no_of_hours'];
    ?>
    <div class="container bodycontainer">
      <div class="row">
        <div class="col s12 collection">
                <div class="row">
                  <div class="col s12 m12">
                    <div class="card">
                      <div class="card-content">
                        <h5 class="center">Class ID #<?php pr($class_id); ?></h5>
                        <p><?php pr($class_description); ?></p>
                        <p><strong>Program Title:</strong> <u><?php pr($program_title); ?></u></p>
                        <p>
                          <strong>Startdate: </strong><?php pr($startdate); ?>
                          <strong>Enddate: </strong><?php pr($enddate); ?>
                        </p>
                        <p><strong>Schedule: </strong><?php pr($timesched. " - (" .$daysched. ")"); ?></p>
                        <p><strong>School Year: </strong><?php pr($school_year); ?></p>
                        <p><strong>Semester: </strong><?php pr($semester); ?></p>
                        <p><strong>Required Hours: </strong><?php pr($no_of_hours); ?></p>
                        </div>
                      </div>
                    </div>
                  </div>

                  <!-- Modal Structure -->
                  <div id="modal<?php echo $subplan_no; ?>" class="modal">
                    <div class="modal-content">
                      <h4>Warning!</h4>
                      <p>Are you sure you want to terminate your subscription with an ID of <?php echo $subplan_no; ?>?</p>
                    </div>
                    <div class="modal-footer">
                      <a href="/practicumhub/home/deletesubs/<?php echo $subplan_no; ?>" class=" modal-action waves-effect btn red">Yes</a>
                      <a href="" class=" modal-action modal-close waves-effect waves-green btn">No</a>
                    </div>
                  </div>
          </div>
        </div>
      </div>
    <?php
  }
  else {
    ?>
    <div class="signin row container">
      <form class="col s12" method="post">
        <h4 class="center brown-text">Enroll to Class</h4>
        <div class="row">
          <div class="input-field col s12">
            <i class="material-icons prefix">vpn_key</i>
            <input id="enrollmentkey" type="text" name="enrollmentkey" value="" required>
            <label for="enrollmentkey">Enrollment Key</label>
          </div>
          <div class="col s12">
            <input class="btn col s12" type="submit" value="Enroll Class" name="enroll">
          </div>
        </div>
      </form>
    </div>
    <?php
  }

?>
