<div class="container bodycontainer">
  <div class="row">
    <div class="col s12">
      <h5 class="center">My Interns</h5>
      <table class="highlight" column="4">
        <thead>
          <tr>
            <th>Intern ID</th>
            <th>Name</th>
            <th>Progress</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php
            $myInterns = getAllMyInterns();
            if(count($myInterns)>0) {
              foreach ($myInterns as $row) {
                $intern_id = $row['intern_id'];
                $name = $row['firstname']. " " .$row['middlename']. " " .$row['lastname'];
                $progress = $row['hours_done']/$row['no_of_hours']*100;
                $student_id = $row['acct_no'];
                if($progress>100) {
                  $progress = "Completed 100";
                }
                ?>
                  <tr>
                    <td><?php pr($intern_id); ?></td>
                    <td><?php pr($name); ?></td>
                    <td><?php pr($progress."%"); ?></td>
                    <td>
                      <a href="/practicumhub/home/internprofile/<?php pr($intern_id); ?>" class="btn">
                        Profile
                      </a>
                      <a href="/practicumhub/home/viewinterndtr/<?php pr($intern_id); ?>" class="btn">
                        DTR
                      </a>
                    </td>
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
