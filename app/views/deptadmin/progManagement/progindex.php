<div class="fixed-action-btn" style="bottom: 45px; right: 24px;">
  <a class="btn-floating btn-large #9a8989" href="/practicumhub/home/addprog">
    <i class="large material-icons">add</i>
  </a>
</div>
<div class="container bodycontainer">
  <div class="row">
    <div class="col s12 collection">
      <?php

        $allProg = retAllMyActiveProg();
        if(count($allProg)>0) {
          foreach($allProg as $row) {
            $program_id = $row['program_id'];
            $program_title = $row['program_title'];
            $program_description = $row['program_description'];
            $semester = $row['semester'];
            $school_year = $row['school_year'];
            $startdate = $row['startdate'];
            $enddate = $row['enddate'];
            $no_of_hours = $row['no_of_hours'];
            $status = $row['status'];
            $department_id = $row['department_id'];
            ?>
            <div class="row">
              <div class="col s12 m12">
                <div class="card">
                  <div class="card-content">
                    <h5 class="center">Practicum Program ID #<?php pr($program_id); ?></h5>
                    <h5><?php pr($program_title); ?></h5>
                    <p><?php pr($program_description); ?></p>
                    <p><?php pr($school_year); ?></p>
                    <p><strong>Semester: </strong><?php pr($semester); ?></p>
                    <p>
                      <strong>Startdate: </strong><?php pr($startdate); ?>
                      <strong>Enddate: </strong><?php pr($enddate); ?>
                    </p>
                    <p><strong>Number of Hours Required: </strong><?php pr($no_of_hours); ?></p>
                    <p><strong>Program Status: </strong><?php pr($status); ?></p>
                  </div>
                  <div class="card-action">
                    <a href="/practicumhub/home/updateprog/<?php pr($program_id); ?>">Update</a>
                    <a class="modal-trigger" href="#modal<?php pr($program_id); ?>">Delete</a>
                  </div>
                </div>
              </div>
            </div>

            <!-- Modal Structure -->
            <div id="modal<?php pr($program_id); ?>" class="modal">
              <div class="modal-content">
                <h4>Warning!</h4>
                <p>Are you sure you want to delete the program with an ID of <?php pr($program_id); ?>?</p>
              </div>
              <div class="modal-footer">
                <a href="/practicumhub/home/deleteprog/<?php pr($program_id); ?>" class=" modal-action waves-effect btn red">Yes</a>
                <a href="" class=" modal-action modal-close waves-effect waves-green btn">No</a>
              </div>
            </div>
            <?php
          }
        }
        else {
          ?>
          <div class="row">
            <div class="col s12 m12">
              <div class="card">
                <div class="card-content">
                  <h5 class="center">You don't have any existing program.</h5>
                  </div>
                  <div class="card-action">
                    <a href="/practicumhub/home/addprog">Add Program</a>
                  </div>
                </div>
              </div>
            </div>
          <?php
        }
      ?>
    </div>
  </div>
</div>
