<style media="screen" type="text/css">
  .row {
    margin-bottom: 0px;
  }
</style>
<?php

  if(isset($_POST['submitjoin'])) {
    $deptid = $_POST['deptid'];
    $deptkey = $_POST['deptkey'];

    $data = array($deptid, $deptkey);

    adviserJoinDept($data);
  }

?>
<!-- <div class="fixed-action-btn" style="bottom: 45px; right: 24px;">
  <a class="btn-floating btn-large #9a8989">
    <i class="large material-icons">add</i>
  </a>
  <ul>
    <li><a class="btn-floating #9a8989 tooltipped" data-position="left" data-delay="50" data-tooltip="Add School" href="/practicumhub/home/addpartner/school">S</a></li>
    <li><a class="btn-floating #9a8989 tooltipped" data-position="left" data-delay="50" data-tooltip="Add Company" href="/practicumhub/home/addpartner/company">C</a></li>
  </ul>
</div> -->
<div class="container bodycontainer">
  <div class="row">
    <div class="col s12 collection">
      <ul class="collapsible" data-collapsible="accordion">
      <?php

      $allSchoolDepts = retrieveSchoolActiveDept();
      if(count($allSchoolDepts)>0) {
        foreach($allSchoolDepts as $row) {
          $department_id = $row['department_id'];
          $department_key = $row['department_key'];
          $school_name = $row['school_name'];
          $department_dean = $row['department_dean'];
          $department_name = $row['department_name'];
          $contact_no = $row['contact_no'];
            ?>
            <li>
              <div class="collapsible-header"><?php pr("<strong>" .$department_name. "</strong>"); ?></div>
              <div class="collapsible-body">
                <div class="row">
                  <div class="col s12 m12">
                    <div class="card">
                      <div class="card-content">
                        <h5 class="center">Department ID #<?php pr($department_id); ?></h5>
                        <p><strong>School Name: </strong><?php pr($department_name); ?></p>
                        <p><strong>School Address: </strong><?php pr($department_dean); ?></p>
                        <p><strong>Contact Number: </strong><?php pr($contact_no); ?></p>
                        <p><strong>School Campus: </strong><?php pr($school_name); ?></p>
                      </div>
                      <div class="card-action">
                        <a class="modal-trigger" href="#modal<?php pr($department_id); ?>">Join</a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </li>
          <!-- Modal Structure -->
          <div id="modal<?php pr($department_id); ?>" class="modal">
            <div class="modal-content">
              <div class="row">
                <div class="col s2">

                </div>
                <div class="col s8">
                  <h5>Enter School's Key to continue</h5>
                  <form class="col s12" method="post">
                    <div class="input-field col s12">
                      <i class="material-icons prefix"></i>
                      <input id="deptid" type="text" name="deptid" value="<?php pr($department_id); ?>" required readonly>
                      <label for="deptid">Department ID</label>
                    </div>
                    <div class="input-field col s12">
                      <i class="material-icons prefix">vpn_key</i>
                      <input id="deptkey" type="text" name="deptkey" required autofocus>
                      <label for="deptkey">Department Key</label>
                      <input class="btn" type="submit" name="submitjoin" value="Submit">
                    </div>
                  </form>
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
      }
      else {
        ?>
        <div class="row">
          <div class="col s12 m12">
            <div class="card">
              <div class="card-content">
                <h5 class="center">There's no available joining of paper and many more.</h5>
              </div>
              <div class="card-action">
                <a href="/practicumhub/home/addpartner/school">Add School</a>
                <a href="/practicumhub/home/addpartner/company">Add Company</a>
              </div>
            </div>
          </div>
        </div>
        <?php
      }
      ?>
      </ul>
    </div>
  </div>
</div>
