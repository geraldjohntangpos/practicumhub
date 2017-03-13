<?php

  if(isset($_POST['request'])) {
    $jobid = $_POST['jobid'];
    $slots = $_POST['slots'];
    $department_id = retrieveMyDept()[0]['department_id'];

    $data = array($jobid, $department_id, $slots);
    // var_dump($data);
    addRequest($data);
  }

?>

<div class="container bodycontainer">
  <div class="row">
    <div class="col s12 collection">
      <?php
        $allJobs = getAllJobs();
        $max = count(getJoblessStudInMyDept());

        if(count($allJobs)>0) {
          foreach ($allJobs as $row) {
            $job_id = $row['job_id'];
            $job_desc = $row['job_desc'];
            $slots_available = $row['slots_available'];
            $date_posted = $row['date_posted'];
            $acct_no = $row['acct_no'];
            $image = $row['image'];
            $firstname = $row['firstname'];
            $middlename = $row['middlename'];
            $lastname = $row['lastname'];
            $date_posted = $row['date_posted'];
            $company_name = $row['company_name'];

            if($max>$slots_available) {
              $max = $slots_available;
            }
            ?>
            <div class="row">
              <div class="col s12 m12">
                <div class="card">
                  <div class="card-content">
                    <div class="col s12">
                      <img src="../images/profile/<?php pr($image); ?>" alt="" class="profileImg col s1" height="60px" width="60px">
                      <p class="col s11">
                        <strong>
                          <?php pr($firstname. " " .$middlename. " " .$lastname. " (" .$company_name. ")"); ?>
                        </strong>
                        <br />
                        <p class="timepost grey-text">
                          <?php pr($date_posted); ?>&nbsp;&nbsp;&nbsp;
                          <i class="material-icons tiny">watch_later</i>
                        </p>
                      </p>
                      <div class="divider">
                      </div>
                    </div>
                    <p><?php echo $job_desc; ?></p>
                    <p><strong>Slots Available:</strong> <u><?php echo $slots_available; ?></u></p>
                    </div>
                  </div>
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
                  <h5 class="center">No job offering available.</h5>
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
