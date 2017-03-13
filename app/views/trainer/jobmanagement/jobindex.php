<?php

if(isset($_POST['post'])) {
  $job_desc = $_POST['description'];
  $slots_available = $_POST['slots'];
  $date_posted = myDateNow();
  $acct_no = $_SESSION['ACCT_NO'];

  $data = array($job_desc, $slots_available, $date_posted, $acct_no);
  postJob($data);
}

?>

<div class="container bodycontainer">
  <div class="row">
    <div class="col s12 collection">
    <?php
      $allPostLeft = getAllPostLeft(array($_SESSION['ACCT_NO']));
      if($allPostLeft > 0) {
        ?>
          <div class="row">
            <div class="col s12 m12">
              <div class="card">
                <div class="card-content">
                  <div class="row">
                    <form class="row jobpost" method="post">
                      <div class="input-field col s12">
                        <textarea id="description" class="materialize-textarea" name="description" length="10000"></textarea>
                        <label for="description">Job Description</label>
                      </div>
                      <div class="input-field col s12">
                        <input id="slots" type="number" name="slots" min="1" required>
                        <label for="slots">Slots Available</label>
                      </div>
                      <div class="right">
                        <input class="btn" type="submit" value="Post" name="post">
                      </div>
                    </form>
                  </div>
                </div>
                <div class="card-action">
                <!-- <a href="/practicumhub/home/addsubs">Post</a> -->
                <p>Post Left: <?= $allPostLeft; ?></p>
              </div>
              </div>
            </div>
          </div>
        <?php
      }
    ?>
    <div class="spacer">
    </div>
    <div class="divider">
    </div>
    <div class="spacer">
    </div>
    <?php
    $myPosts = getMyActivePost();

    if(count($myPosts)>0) {
      foreach ($myPosts as $row) {
        $job_id = $row['job_id'];
        $job_desc = $row['job_desc'];
        $slots_available = $row['slots_available'];
        $date_posted = $row['date_posted'];
        $acct_no = $row['acct_no'];
        ?>
        <div class="row">
          <div class="col s12 m12">
            <div class="card">
              <div class="card-content">
                <p><?php echo $job_desc; ?></p>
                <p><strong>Slots Available:</strong> <u><?php echo $slots_available; ?></u></p>
                <p><strong>Startdate: </strong><?php echo $date_posted; ?></p>
                <?php
                $jobRequests = getJobRequest(array($job_id));
                ?>
                <p>
                  <strong>Pending Job Applicants:</strong>
                  <a href="#job<?php pr($job_id); ?>" class="modal-trigger"><?php pr(count($jobRequests)); ?></a>
                </p>
                <div id="job<?php pr($job_id); ?>" class="modal">
                  <div class="modal-content">
                    <?php
                    if(count($jobRequests)>0) {
                      ?>
                      <p><strong>Student(s) that applied for this job.</strong></p>
                      <table class="highlight">
                        <thead>
                          <tr>
                            <th>Name</th>
                            <th>School</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          foreach ($jobRequests as $row) {
                            $student_id = $row['acct_no'];
                            $name = $row['firstname']. " " .$row['middlename']. " " .$row['lastname'];
                            $school_name = $row['school_name'];
                            $request_id = $row['request_id'];
                            ?>
                            <tr>
                              <td><?php pr($name); ?></td>
                              <td><?php pr($school_name); ?></td>
                              <td>
                                <a href="/practicumhub/home/acceptreq/<?= $student_id; ?>/<?= $job_id; ?>/<?= $request_id; ?>" class="btn">
                                  <i class="material-icons">done</i>
                                </a>
                                <a href="/practicumhub/home/delpendingreq/<?php pr($request_id); ?>" class="btn red">
                                  <i class="material-icons">clear</i>
                                </a>
                              </td>
                            </tr>
                            <?php
                          }
                          ?>
                        </tbody>
                      </table>
                      <?php
                    }
                    else {
                      pr("<p><strong>There is no pending request for this job</strong></p>");
                    }
                    ?>
                  </div>
                  <div class="modal-footer">
                    <a class="modal-action modal-close btn red">
                      <i class="material-icons">clear</i>
                    </a>
                  </div>
                </div>
              </div>
              <div class="card-action">
                <a href="#">Update</a>
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
              <h5 class="center">You don't have any existing job offers.</h5>
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
