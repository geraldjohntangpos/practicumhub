<?php

  if(isset($_POST['joinschool'])) {

  }

  $school = retrieveAdviserSchool(array($_SESSION['ACCT_NO']));
  if(count($school)>0) {
    foreach($school as $row) {
      $school_name = $row['school_name'];
      $school_campus = $row['school_campus'];
      $school_address = $row['school_address'];
      $contact_no = $row['contact_no'];
      $partner_key = $row['partner_key'];
      $school_image = $row['school_image'];
    }
    ?>
    <!-- <div class="fixed-action-btn" style="bottom: 45px; right: 24px;">
      <a class="btn-floating btn-large #9a8989">
        <i class="large material-icons">add</i>
      </a>
      <ul>
        <li><a class="btn-floating #9a8989 tooltipped" data-position="left" data-delay="50" data-tooltip="Leave School" href="/practicumhub/home/addpartner/school">S</a></li>
        <li><a class="btn-floating #9a8989 tooltipped" data-position="left" data-delay="50" data-tooltip="Add Company" href="/practicumhub/home/addpartner/company">C</a></li>
      </ul>
    </div> -->
    <div class="container">
      <div class="profilebody row">
        <div class="col s12 m5">
          <img src="../images/school/<?php pr($school_image); ?>" class="profileImg responsive-img" alt="Hipster">
          <h5 class="center"><?php pr($school_name); ?> <a href="#" class="dropdown-button" data-activates='editlistschool'><i class="material-icons">mode_edit</i></a></h5>
            <!-- Dropdown Structure -->
            <ul id='editlistschool' class='dropdown-content black-text'>
              <li><a href="/practicumhub/home/managesubs">Existing</a></li>
              <?php
                $myRole = getRole(array($_SESSION['ACCT_NO']));
                if($myRole != "department admin/School admin") {
              ?>
              <li class="divider"></li>
              <li><a class="modal-trigger red-text" href="#confirmleave">Leave</a></li>
              <?php
                }
              ?>
            </ul>
        </div>

        <!-- Modal Structure -->
        <div id="confirmleave" class="modal">
          <div class="modal-content">
            <div class="row">
              <div class="col s2">

              </div>
              <div class="col s8">
                <h5>Are you sure you want to leave the school?</h5>
              </div>
              <div class="col s2">

              </div>
            </div>
          </div>
          <div class="modal-footer">
            <a href="/practicumhub/home/leaveschool" class=" modal-action modal-close waves-effect waves-red btn red">
              <i class="large material-icons">check</i>
            </a>
            <a href="" class=" modal-action modal-close waves-effect waves-red btn">
              <i class="large material-icons">clear</i>
            </a>
          </div>
        </div>

        <div class="col s12 m7">
          <p>Campus: <u><?php pr($school_campus); ?></u></p>
          <p>Address: <u><?php pr($school_address); ?></u></p>
          <p>Contact Number: <u><?php pr($contact_no); ?></u></p>
          <p>School Access Key: <u><?php pr($partner_key); ?></u></p>
          <?php
            $department = retrieveAdviserDept();
            if(count($department)>0) {
              foreach($department as $row) {
                $department_key = $row['department_key'];
                $department_name = $row['department_name'];
                $department_dean = $row['department_dean'];
                $contact_no = $row['contact_no'];
              }
              ?>
              <p>Department:
                <a href="#deptmodal" class="modal-trigger black-text">
                  <u><?php pr($department_name); ?></u>
                </a>
                <a href="#" class="dropdown-button" data-activates='editlistdept'>
                  <i class="material-icons">mode_edit</i>
                </a>
              </p>
              <!-- Modal Structure -->
              <div id="deptmodal" class="modal">
                <div class="modal-content">
                  <div class="row">
                    <div class="col s2">

                    </div>
                    <div class="col s8">
                      <h5 class="center">Department Info</h5>
                      <p>Name: <u><?php pr($department_name); ?></u></p>
                      <p>Key: <u><?php pr($department_key); ?></u></p>
                      <p>Dean: <u><?php pr($department_dean); ?></u></p>
                      <p>Contact: <u><?php pr($contact_no); ?></u></p>
                    </div>
                    <div class="col s2">

                    </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <a href="" class=" modal-action modal-close waves-effect waves-red btn red"><i class="large material-icons">clear</i></a>
                </div>
              </div>
              <?php
            }
            else {
              ?>
              <p>Department: <u class="red-text">No Department Yet</u> <a href="#" class="dropdown-button" data-activates='editlistdept'><i class="material-icons">mode_edit</i></a></p>
              <?php
            }
          ?>
          <!-- Dropdown Structure -->
          <ul id='editlistdept' class='dropdown-content black-text'>
            <li><a href="/practicumhub/home/joindept">Existing</a></li>
          </ul>
        </div>
      </div>
    </div>
    <?php
  }
  else {
    ?>
    <div class="container">
      <div class="row">
        <div class="col s12 m12">
          <div class="card">
            <div class="card-content">
              <h5 class="center">You don't belong to any school.</h5>
            </div>
            <div class="card-action">
              <a href="/practicumhub/home/addschool">Add School</a>
              <a href="/practicumhub/home/joinschool">Join Existing</a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php
  }

?>
