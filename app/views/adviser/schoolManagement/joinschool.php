<style media="screen" type="text/css">
  .row {
    margin-bottom: 0px;
  }
</style>
<?php

  if(isset($_POST['submitjoin'])) {
    $schoolid = $_POST['schoolid'];
    $partnerkey = $_POST['partnerkey'];

    $data = array($schoolid, $partnerkey);

    adviserJoinExistingSchool($data);
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

      $allSchools = retrieveAvailableSchool();
      if(count($allSchools)>0) {
        foreach($allSchools as $row) {
          $school_id = $row['school_id'];
          $partner_id = $row['partner_id'];
          $school_name = $row['school_name'];
          $school_address = $row['school_address'];
          $school_campus = $row['school_campus'];
          $contact_no = $row['contact_no'];
          $school_image = $row['school_image'];
          $partner_status = $row['partner_status'];
          $school_id = $row['school_id'];
          $dept_admin_id = $row['dept_admin_id'];
          $acct_no = $row['acct_no'];
          $firstname = $row['firstname'];
          $middlename = $row['middlename'];
          $lastname = $row['lastname'];
          $type = $row['type'];
            ?>
            <li>
              <div class="collapsible-header"><?php pr("<strong>" .$school_name. "</strong>"); ?></div>
              <div class="collapsible-body">
                <div class="row">
                  <div class="col s12 m12">
                    <div class="card">
                      <div class="card-content">
                        <h5 class="center">School ID #<?php pr($school_id); ?></h5>
                        <p><strong>School Name: </strong><?php pr($school_name); ?></p>
                        <p><strong>School Campus: </strong><?php pr($school_campus); ?></p>
                        <p><strong>School Address: </strong><?php pr($school_address); ?></p>
                        <p><strong>Contact Number: </strong><?php pr($contact_no); ?></p>
                        <p><strong>Partner Status: </strong><?php pr($partner_status); ?></p>
                      </div>
                      <div class="card-action">
                        <a class="modal-trigger" href="#modal<?php pr($partner_id); ?>">Join</a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </li>
          <!-- Modal Structure -->
          <div id="modal<?php pr($partner_id); ?>" class="modal">
            <div class="modal-content">
              <div class="row">
                <div class="col s2">

                </div>
                <div class="col s8">
                  <h5>Enter School's Key to continue</h5>
                  <form class="col s12" method="post">
                    <div class="input-field col s12">
                      <i class="material-icons prefix"></i>
                      <input id="schoolid" type="text" name="schoolid" value="<?php pr($school_id); ?>" required readonly>
                      <label for="schoolid">School ID</label>
                    </div>
                    <div class="input-field col s12">
                      <i class="material-icons prefix">vpn_key</i>
                      <input id="partnerkey" type="text" name="partnerkey" required autofocus>
                      <label for="partnerkey">Partner Key</label>
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
                <h5 class="center">There's no available school right now.</h5>
              </div>
              <!-- <div class="card-action">
                <a href="/practicumhub/home/addpartner/school">Add School</a>
                <a href="/practicumhub/home/addpartner/company">Add Company</a>
              </div> -->
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
