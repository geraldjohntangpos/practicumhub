<div class="container bodycontainer">
  <div class="row">
    <div class="col s12 collection">
      <?php
        $allSubPlans = getAllSubPlans();

        if(count($allSubPlans)>0) {
          foreach($allSubPlans as $row) {
            $subplan_no = $row['subplan_no'];
            $subscribername = $row['firstname']. " " .$row['middlename']. " " .$row['lastname'];
            $keygen = $row['keygen'];
            $startdate = $row['startdate'];
            $enddate = $row['enddate'];
            $sub_status = $row['sub_status'];
            $description = $row['description'];
            $acctType = $row['type'];
            $acct_no = $row['acct_no'];
            ?>
            <div class="row">
              <div class="col s12 m12">
                <div class="card">
                  <div class="card-content">
                    <h5 class="center">Subplan ID #<?php echo $subplan_no; ?></h5>
                    <p><?php echo $description; ?></p>
                    <p><strong>Subscriber Name:</strong> <?php echo $subscribername; ?></p>
                    <p><strong>Subscription Key:</strong> <u><?php echo $keygen; ?></u></p>
                    <p>
                      <strong>Startdate: </strong><?php echo $startdate; ?>
                      <strong>Enddate: </strong><?php echo $enddate; ?>
                    </p>
                    <p><strong>Subscription Status: </strong><?php echo $sub_status; ?></p>
                    <?php
                      if($acctType == "department admin/School admin") {
                        ?>
                          <p class="red-text"><strong>Bill: </strong><?php echo computeHeadCount(array($acct_no)); ?></p>
                        <?php
                      }
                    ?>
                    </div>
                  </div>
                </div>
              </div>
            <?php
          }
        }

      ?>
      </div>
    </div>
  </div>
