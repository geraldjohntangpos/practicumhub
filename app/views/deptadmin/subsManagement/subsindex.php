<div class="fixed-action-btn" style="bottom: 45px; right: 24px;">
  <a class="btn-floating btn-large #9a8989" href="/practicumhub/home/addsubs">
    <i class="large material-icons">add</i>
  </a>
</div>
<div class="container bodycontainer">
  <div class="row">
    <div class="col s12 collection">
      <?php
        $mySubs = retrieveMySubs(array($_SESSION['ACCT_NO']));

        if(count($mySubs)>0) {
          foreach ($mySubs as $row) {
            $subplan_no = $row['subplan_no'];
            $keygen = $row['keygen'];
            $startdate = $row['startdate'];
            $enddate = $row['enddate'];
            $sub_status = $row['sub_status'];
            $description = $row['description'];
            ?>
            <div class="row">
              <div class="col s12 m12">
                <div class="card">
                  <div class="card-content">
                    <h5 class="center">Subplan ID #<?php echo $subplan_no; ?></h5>
                    <p><?php echo $description; ?></p>
                    <p><strong>Subscription Key:</strong> <u><?php echo $keygen; ?></u></p>
                    <p>
                      <strong>Startdate: </strong><?php echo $startdate; ?>
                      <strong>Enddate: </strong><?php echo $enddate; ?>
                    </p>
                    <p><strong>Subscription Status: </strong><?php echo $sub_status; ?></p>
                    <p><strong>Head Count: </strong><?php echo getHeadCount(). " <i>*rate 5.00/studets</i>"; ?></p>
                    </div>
                    <div class="card-action">
                      <a href="/practicumhub/home/updatesubs/<?php echo $subplan_no; ?>">Update</a>
                      <a class="modal-trigger" href="#modal<?php echo $subplan_no; ?>">Delete</a>
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
            <?php
          }
        }
        else {
          ?>
          <div class="row">
            <div class="col s12 m12">
              <div class="card">
                <div class="card-content">
                  <h5 class="center">You don't have any existing subscription.</h5>
                  </div>
                  <div class="card-action">
                    <a href="/practicumhub/home/addsubs">Add Subscription Plan</a>
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
