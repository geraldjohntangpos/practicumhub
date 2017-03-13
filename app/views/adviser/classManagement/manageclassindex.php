<div class="fixed-action-btn" style="bottom: 45px; right: 24px;">
  <a class="btn-floating btn-large #9a8989" href="/practicumhub/home/addclass">
    <i class="large material-icons">add</i>
  </a>
</div>
<div class="container bodycontainer">
  <div class="row">
    <div class="col s12 collection">
      <?php

        $allClass = retrieveAllMyClass();
        if(count($allClass)>0) {
          foreach($allClass as $row) {
            $class_id = $row['class_id'];
            $program_id = $row['program_id'];
            $program_title = $row['program_title'];
            $adviser_name = $row['firstname']. " " .$row['middlename']. " " .$row['lastname'];
            $class_description = $row['class_description'];
            $enrollment_key = $row['enrollment_key'];
            $class_time_sched = $row['class_time_sched'];
            $class_day_sched = $row['class_day_sched'];
            $status = $row['status'];
            ?>
            <div class="row">
              <div class="col s12 m12">
                <div class="card">
                  <div class="card-content">
                    <h5 class="center">Class ID #<?php pr($class_id); ?></h5>
                    <p><?php pr($class_description); ?></p>
                    <h5><strong>Program Title: </strong><?php pr($program_title); ?></h5>
                    <h5><strong>Adviser: </strong><?php pr($adviser_name); ?></h5>
                    <p><strong>Enrollment Key: </strong><u><?php pr($enrollment_key); ?></u></p>
                    <p><strong>Class Schedule: </strong><?php pr($class_time_sched. " (<i>" .$class_day_sched); ?></i>)</p>
                    <p><strong>Class Status: </strong><?php pr($status); ?></p>
                    <?php
                      $studentsEnrolledCount = getStudentsEnrolled(array($class_id));
                    ?>
                    <p>
                      <strong>Students enrolled: </strong>
                      <u>
                        <a class="modal-trigger" href="#studlistmodal<?php pr($class_id); ?>">
                           <?php pr(count($studentsEnrolledCount)); ?>
                        </a>
                      </u>
                    </p>
                    <?php
                      if(count($studentsEnrolledCount)>0) {
                        ?>
                        <!-- Modal Structure -->
                        <div id="studlistmodal<?php pr($class_id); ?>" class="modal">
                          <div class="modal-content">
                            <h4>Students List</h4>
                            <?php
                              foreach ($studentsEnrolledCount as $row) {
                                $firstname = $row['firstname'];
                                $middlename = $row['middlename'];
                                $lastname = $row['lastname'];
                                $stud_acct_no = $row['acct_no'];
                                ?>
                                <p>

                                <a href="/practicumhub/home/managedtr/<?= $stud_acct_no; ?>"><?php pr($firstname. " " .$middlename. " " .$lastname); ?></a>

                                </p>
                                <?php
                              }
                            ?>
                          </div>
                          <div class="modal-footer">
                            <a href="" class=" modal-action modal-close waves-effect waves-green btn">
                              <i class="material-icons">clear</i>
                            </a>
                          </div>
                        </div>
                        <?php
                      }
                      else {
                        ?>
                        <!-- Modal Structure -->
                        <div id="studlistmodal<?php pr($class_id); ?>" class="modal">
                          <div class="modal-content">
                            <h4>Warning!</h4>
                            <p>Empty</p>
                          </div>
                          <div class="modal-footer">
                            <a href="" class=" modal-action modal-close waves-effect waves-green btn">
                              <i class="material-icons">clear</i>
                            </a>
                          </div>
                        </div>
                        <?php
                      }
                    ?>
                  </div>
                  <div class="card-action">
                    <a href="/practicumhub/home/updateclass/<?php pr($class_id); ?>">Update</a>
                    <a class="modal-trigger" href="#modal<?php pr($class_id); ?>">Delete</a>
                  </div>
                </div>
              </div>
            </div>

            <!-- Modal Structure -->
            <div id="modal<?php pr($class_id); ?>" class="modal">
              <div class="modal-content">
                <h4>Warning!</h4>
                <p>Are you sure you want to delete the class with an ID of <?php pr($class_id); ?>?</p>
              </div>
              <div class="modal-footer">
                <a href="/practicumhub/home/deleteclass/<?php pr($class_id); ?>" class=" modal-action waves-effect btn red">Yes</a>
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
                  <h5 class="center">You don't have any existing class.</h5>
                  </div>
                  <div class="card-action">
                    <a href="/practicumhub/home/addclass">Add Class</a>
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
