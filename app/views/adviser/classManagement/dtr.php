<div class="fixed-action-btn" style="bottom: 45px; right: 24px;">
  <a class="btn-floating btn-large #9a8989" href="/practicumhub/home/manageclass">
    <i class="large material-icons">clear</i>
  </a>
</div>
<?php

  if(isset($_POST['submit'])) {
    $dtr_id = $_POST['dtrid'];
    $diary = $_POST['diary'];
    $data = array($diary, $dtr_id);
    editDiary($data);
  }

?>

<div class="container bodycontainer">
  <div class="row">
    <div class="col s12 white">
      <table class="highlight">
        <thead>
          <tr>
            <th>DTR ID</th>
            <th>Time In</th>
            <th>Time Out</th>
            <th>Diary</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td colspan="5" class="center">
            </td>
          </tr>
          <?php
            $myDtr = getMyDtr2(array($baseurl[2]));

            if(count($myDtr)>0) {
              foreach ($myDtr as $row) {
                $dtr_id = $row['dtr_id'];
                $time_in = $row['time_in'];
                $time_out = $row['time_out'];
                $diary = $row['diary'];
                $dtr_status = $row['dtr_status'];
                ?>
                <tr>
                  <td><?php pr($dtr_id); ?></td>
                  <td><?php pr($time_in); ?></td>
                  <td><?php pr($time_out); ?></td>
                  <td>
                    <?php
                      if($diary == "") {
                        ?>
                        <a
                        class="red-text modal-trigger">No Entry
                        </a>
                        <?php
                      }
                      else {
                        ?>
                        <a href="#diary<?php pr($dtr_id); ?>"
                        class="modal-trigger">View Diary
                        </a>
                        <?php
                      }
                    ?>
                  </td>
                  <td><?php pr($dtr_status); ?></td>
                  <!-- Modal Structure -->
                  <div id="diary<?php pr($dtr_id); ?>" class="modal">
                  <div class="modal-content">
                    <div class="row">
                      <div class="col s2">
                      </div>
                      <div class="col s8">
                        <form class="col s12" method="post">
                          <div class="input-field col s12">
                            <input id="dtrid" type="text" name="dtrid" value="<?php pr($dtr_id); ?>" readonly>
                            <label for="dtrid">DTR ID</label>
                          </div>
                          <div class="input-field col s12">
                            <textarea id="diary" name="diary" class="materialize-textarea" length="500" readonly><?= $diary; ?></textarea>
                            <label for="diary">Diary</label>
                          </div>
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
                </tr>
                <?php
              }
            }
          ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
