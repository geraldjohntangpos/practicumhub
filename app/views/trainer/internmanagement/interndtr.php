<?php

  if(isset($_POST['record'])) {
    $dtr_id = $_POST['dtrid'];
    $student_id = getInternStudId(array($intern_id));
    $hour = $_POST['hour'];
    $minutes = $_POST['minutes'];
    $time = $minutes+hourToMin($hour);
    $hours_done = $hour+minToDecimal($minutes);
    $data = array($hours_done, $student_id);
    recordPending($data, $intern_id, $dtr_id);
  }

?>

<div class="fixed-action-btn" style="bottom: 45px; right: 24px;">
  <a href="/practicumhub/home/manageinterns" class="btn-floating btn-large">
    <i class="large material-icons">clear</i>
  </a>
</div>
<div class="container bodycontainer">
  <div class="row">
    <?php
      $pendingDtr = getInternPendingDtr(array($intern_id));
      if(count($pendingDtr)>0) {
        ?>
        <h5 class="center">Pending DTR</h5>
        <div class="col s12 collection">
          <?php
            foreach ($pendingDtr as $row) {
              $dtr_id = $row['dtr_id'];
              $intern_id = $row['intern_id'];
              $diary = $row['diary'];
              $time_in = $row['time_in'];
              $time_out = $row['time_out'];
              $dtr_status = $row['dtr_status'];
              ?>
              <div class="row">
                <div class="col s12">
                  <div class="card">
                    <div class="card-content">
                      <div class="row">
                          <p><strong>Time in: </strong><?php pr($time_in. " (<i>".getDayWeek(splitDateTime($time_in))."<i>)"); ?></p>
                          <p><strong>Time Out: </strong><?php pr($time_out. " (<i>".getDayWeek(splitDateTime($time_out))."</i>)"); ?></p>
                          <p>
                            <?php
                              $ttd = convHrMin(countDutyTime(splitDateTime($time_in), splitDateTime($time_out)));
                            ?>
                            <strong>Total Time Duty: </strong>
                            <?php echo $ttd['hr'].":".$ttd['min']; ?>
                          </p>
                          <p><strong>Diary: </strong><?php pr($diary); ?></p>
                      </div>
                    </div>
                    <div class="card-action">
                      <a href="#modal<?php pr($dtr_id); ?>" class="modal-trigger green-text">
                        Accept
                      </a>
                      <a href="/practicumhub/home/declinepending/<?php pr($dtr_id."/".$intern_id); ?>" class="red-text">
                        Decline
                      </a>
                    </div>
                    <!-- Modal Structure -->
                    <div id="modal<?php pr($dtr_id); ?>" class="modal">
                    <div class="modal-content">
                      <div class="row">
                        <div class="col s2">
                        </div>
                        <div class="col s8">
                          <form class="col s12" method="post">
                            <div class="input-field col s12">
                              <input id="dtrid" type="text" name="dtrid" value="<?php pr($dtr_id); ?>" required readonly>
                              <label for="dtrid">DTR ID</label>
                            </div>
                            <div class="input-field col s6">
                              <input id="hour" type="number" min="0" max="<?php pr($ttd['hr']); ?>" value="<?php pr($ttd['hr']); ?>" name="hour" required
                                <?php
                                  if($ttd['hr'] != 0) {
                                    echo 'autofocus ';
                                  }
                                  else {
                                    echo 'readonly';
                                  }
                                ?>
                              >
                              <label for="hour">Hours</label>
                            </div>
                            <div class="input-field col s6">
                              <input id="minutes" type="number" min="0" max="<?php pr($ttd['min']); ?>" value="<?php pr($ttd['min']); ?>" name="minutes" required autofocus>
                              <label for="minutes">Minutes</label>
                            </div>
                            <input class="btn right" width="100%" type="submit" name="record" value="Record">
                          </form>
                        </div>
                        <div class="col s2">
                        </div>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <a class=" modal-action modal-close waves-effect btn red">
                        <i class="material-icons">clear</i>
                      </a>
                    </div>
                  </div>
                  </div>
                </div>
              </div>
              <?php
            }
          ?>
        </div>
        <?php
      }
    ?>
    <?php
      $recordedDtr = getInternRecordedDtr(array($intern_id));
      if(count($recordedDtr)>0) {
        ?>
        <h5 class="center">Recorded DTR</h5>
        <div class="col s12 collection">
          <?php
            foreach ($recordedDtr as $row) {
              $dtr_id = $row['dtr_id'];
              $intern_id = $row['intern_id'];
              $diary = $row['diary'];
              $time_in = $row['time_in'];
              $time_out = $row['time_out'];
              $dtr_status = $row['dtr_status'];
              ?>
              <div class="row">
                <div class="col s12">
                  <div class="card">
                    <div class="card-content">
                      <div class="row">
                          <p><strong>Time in: </strong><?php pr($time_in. " (<i>".getDayWeek(splitDateTime($time_in))."</i>)"); ?></p>
                          <p><strong>Time Out: </strong><?php pr($time_out. " (<i>".getDayWeek(splitDateTime($time_out))."</i>)"); ?></p>
                          <p>
                            <?php
                              $ttd = convHrMin(countDutyTime(splitDateTime($time_in), splitDateTime($time_out)));
                            ?>
                            <strong>Total Time Duty: </strong>
                            <?php echo $ttd['hr'].":".$ttd['min']; ?>
                          </p>
                          <p><strong>Diary: </strong><?php pr($diary); ?></p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <?php
            }
          ?>
        </div>
        <?php
      }
    ?>
  </div>
</div>
