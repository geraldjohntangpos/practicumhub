<style media="screen" type="text/css">
  .row {
    margin-bottom: 0px;
  }
</style>
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

      $allPartners = retAllActivePartners(array($_SESSION['ACCT_NO']));
      if(count($allPartners)>0) {
        foreach($allPartners as $row) {
          if($row['partner_type'] == 'school') {
            $partner_id = $row['partner_id'];
            $partner_key = $row['partner_key'];
            $partner_type = $row['partner_type'];
            $partner_status = $row['partner_status'];
            $partner_dateadded = $row['partner_dateadded'];
            $school_id = $row['school_id'];
            $school_name = $row['school_name'];
            $school_campus = $row['school_campus'];
            $school_address = $row['school_address'];
            $contact_no = $row['contact_no'];
            $image = $row['school_image'];
            ?>
            <li>
              <div class="collapsible-header"><?php pr("<strong>" .$school_name. "</strong> (School)"); ?></div>
              <div class="collapsible-body">
                <div class="row">
                  <div class="col s12 m12">
                    <div class="card">
                      <div class="card-content">
                        <div class="row">
                          <div class="col s4 m4">
                            <img src="../images/school/<?php echo $image; ?>" class="circle" width="300px" height="300px">
                          </div>
                          <div class="col s8 m8">
                            <h5 class="center">Partner ID #<?php pr($partner_id); ?></h5>
                            <p><strong>Partner Type: </strong><?php pr(ucwords($partner_type)); ?></p>
                            <p><strong>School Name: </strong><?php pr($school_name); ?></p>
                            <p><strong>Partner Key: </strong><u><?php pr($partner_key); ?></u></p>
                            <p><strong>School Campus: </strong><?php pr($school_campus); ?></p>
                            <p><strong>School Address: </strong><?php pr($school_address); ?></p>
                            <p><strong>Contact Number: </strong><?php pr($contact_no); ?></p>
                            <p><strong>Date Added: </strong><?php pr($partner_dateadded); ?></p>
                            <p><strong>Partner Status: </strong><?php pr($partner_status); ?></p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </li>
            <?php
          }
          else {
            $partner_id = $row['partner_id'];
            $partner_key = $row['partner_key'];
            $partner_type = $row['partner_type'];
            $partner_status = $row['partner_status'];
            $partner_dateadded = $row['partner_dateadded'];
            $company_id = $row['company_id'];
            $company_name = $row['company_name'];
            $company_branch = $row['company_branch'];
            $company_address = $row['company_address'];
            $company_contact = $row['company_contact'];
            $image = $row['image'];
            ?>
            <li>
              <div class="collapsible-header"><?php pr("<strong>" .$company_name. "</strong> (Company)"); ?></div>
              <div class="collapsible-body">
                <div class="row">
                  <div class="col s12 m12">
                    <div class="card">
                      <div class="card-content">
                        <div class="row">
                          <div class="col s4 m4">
                            <img src="../images/company/<?php echo $image; ?>" class="circle" width="300px" height="300px">
                          </div>
                          <div class="col s8 m8">
                            <h5 class="center">Partner ID #<?php pr($partner_id); ?></h5>
                            <p><strong>Partner Type: </strong><?php pr(ucwords($partner_type)); ?></p>
                            <p><strong>Company Name: </strong><?php pr($company_name); ?></p>
                            <p><strong>Partner Key: </strong><u><?php pr($partner_key); ?></u></p>
                            <p><strong>Company Branch: </strong><?php pr($company_branch); ?></p>
                            <p><strong>Company Address: </strong><?php pr($company_address); ?></p>
                            <p><strong>Contact Number: </strong><?php pr($company_contact); ?></p>
                            <p><strong>Date Added: </strong><?php pr($partner_dateadded); ?></p>
                            <p><strong>Partner Status: </strong><?php pr($partner_status); ?></p>
                          </div>
                        </div>
                      </div>
                      <div class="card-action">
                        <a href="/practicumhub/home/updatepartner/<?php pr($partner_type. "/" .$partner_id); ?>">Update</a>
                        <a class="modal-trigger" href="#modal<?php pr($partner_id); ?>">Delete</a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </li>
            <!-- <div class="collapsible-header"><?php pr($company_name); ?></div>
            <div class="collapsible-body">
              <div class="row">
                <div class="col s12 m12">
                  <div class="card">
                    <div class="card-content">
                      <h5 class="center">Partner ID #<?php pr($partner_id); ?></h5>
                      <p><strong>Partner Type: </strong><?php pr(ucwords($partner_type)); ?></p>
                      <p><strong>Company Name: </strong><?php pr($company_name); ?></p>
                      <p><strong>Partner Key: </strong><u><?php pr($partner_key); ?></u></p>
                      <p><strong>Company Branch: </strong><?php pr($company_branch); ?></p>
                      <p><strong>Company Address: </strong><?php pr($company_address); ?></p>
                      <p><strong>Contact Number: </strong><?php pr($company_contact); ?></p>
                      <p><strong>Date Added: </strong><?php pr($partner_dateadded); ?></p>
                      <p><strong>Partner Status: </strong><?php pr($partner_status); ?></p>
                    </div>
                    <div class="card-action">
                      <a href="/practicumhub/home/updatepartner/<?php pr($partner_type. "/" .$partner_id); ?>">Update</a>
                      <a class="modal-trigger" href="#modal<?php pr($partner_id); ?>">Delete</a>
                    </div>
                  </div>
                </div>
              </div>
            </div> -->
            <?php
          }
          ?>

          <!-- Modal Structure -->
          <div id="modal<?php pr($partner_id); ?>" class="modal">
            <div class="modal-content">
              <h4>Warning!</h4>
              <p>Are you sure you want to delete our partner with an ID of <?php pr($partner_id); ?>?</p>
            </div>
            <div class="modal-footer">
              <a href="/practicumhub/home/deletepartner/<?php pr($partner_id); ?>" class=" modal-action waves-effect btn red">Yes</a>
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
                <h5 class="center">You don't have any existing partners.</h5>
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
