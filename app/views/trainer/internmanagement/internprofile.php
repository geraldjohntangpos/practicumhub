<div class="fixed-action-btn" style="bottom: 45px; right: 24px;">
  <a href="/practicumhub/home/manageinterns" class="btn-floating btn-large">
    <i class="large material-icons">clear</i>
  </a>
</div>
<?php
?>
<div class="container">
  <div class="profilebody row">
    <div class="col s12 m5">
      <img src="../../images/profile/<?php echo $image; ?>" class="profileImg responsive-img circle" alt="Hipster">
      <h5 class="center"><?php echo $firstname. " " .$middlename. " " .$lastname; ?></h5>
    </div>
    <div class="col s12 m7">
      <p>Address: <u><?php echo $address; ?></u></p>
      <p>Date of birth: <u><?php echo $date_of_birth; ?></u></p>
      <p>Gender: <u><?php echo $gender; ?></u></p>
      <p>Contact Number: <u><?php echo $contactno; ?></u></p>
      <p>Email Address: <u><?php echo $emailadd; ?></u></p>
      <p>Position: <u><?php pr($position); ?></u></p>
      <p>Hired on: <u><?php pr($hiredate); ?></u></p>
      <?php
          $totalHours = $no_of_hours;
          $myHours = $hours_done;
          $percent = ($myHours/$totalHours)*100;
          ?>
            <p>Progress:
          <?php
          if($percent>=100) {
            $percent = 100;
            pr("Completed (" .$percent. "%)");
          }
          else {
            pr($myHours. "/" .$totalHours. " Hours" . " (" .$percent. "%)");
          }
      ?>
      </p>
      <div class="progress">
          <div class="determinate" style="width: <?php pr($percent); ?>%"></div>
      </div>
      <a href="/practicumhub/home/viewinterndtr/<?php pr($intern_id); ?>">View DTR</a>
    </div>
  </div>
</div>
