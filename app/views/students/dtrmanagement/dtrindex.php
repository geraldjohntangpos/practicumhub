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
            <?php
              $status = checkMyLastLogin();
              if($status == 'in') {
                ?>
                  <a href="/practicumhub/home/logindtr" class="btn">Sign in DTR</a>
                <?php
              }
              else {
                ?>
                  <a href="/practicumhub/home/logoutdtr" class="btn red">Sign out DTR</a>
                <?php
              }
            ?>
            </td>
          </tr>
          <?php
            $myDtr = getMyDtr();

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
                    <a href="#diary<?php pr($dtr_id); ?>"
                    <?php
                      if($diary == "") {
                        ?>
                        class="red-text modal-trigger">Add Diary
                        <?php
                      }
                      else {
                        ?>
                        class="modal-trigger">Edit Diary
                        <?php
                      }
                    ?>
                    </a>
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
                            <input id="dtrid" type="text" name="dtrid" value="<?php pr($dtr_id); ?>" required readonly>
                            <label for="dtrid">DTR ID</label>
                          </div>
                          <div class="input-field col s12">
                            <textarea id="diary" name="diary" class="materialize-textarea" length="500" required autofocus><?= $diary; ?></textarea>
                            <label for="diary">Diary</label>
                          </div>
                          <input class="col s12 btn right" width="100%" type="submit" name="submit" value="Submit Diary">
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
