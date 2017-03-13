<script>
$(document).ready(function() 
{ 
 $('form').ajaxForm(function() 
 {
  alert("Uploaded SuccessFully");
 }); 
});

function preview_image() 
{
 var total_file=document.getElementById("pic").files.length;
 for(var i=0;i<total_file;i++)
 {
  $('#picview').html("<img src='"+URL.createObjectURL(event.target.files[i])+"' width='200px' height='200px'><br>");
 }
}

</script>
<?php
  
  if(isset($_POST['upload'])) {
    $pic = $_FILES;
    uploadPic($pic, $_SESSION['ACCT_NO']);
  }

  $acctProfile = getAcctInfo(array($baseurl[1]));
  if(count($acctProfile)>0) {
    foreach($acctProfile as $row) {
      $acct_no = $row['acct_no'];
      $firstname = $row['firstname'];
      $middlename = $row['middlename'];
      $lastname = $row['lastname'];
      $address = $row['address'];
      $date_of_birth = $row['date_of_birth'];
      $gender = $row['gender'];
      $contactno = $row['contactno'];
      $emailadd = $row['emailadd'];
      $image = $row['image'];
      $digitalsign = $row['digitalsign'];
      $type = $row['type'];
    }
  }
  if($baseurl[1] == $_SESSION['ACCT_NO']) {
    ?>
    <div class="fixed-action-btn" style="bottom: 45px; right: 24px;">
      <a class="btn-floating btn-large #9a8989 tooltipped" data-position="left" data-delay="50" data-tooltip="Edit Profle" href="/practicumhub/home/updateprofile/<?php pr($_SESSION['ACCT_NO']); ?>">
        <i class="large material-icons">mode_edit</i>
      </a>
    </div>
    <?php
  }
?>
<div class="container">
  <div class="profilebody row">
    <div class="col s12 m5">
      <img src="../images/profile/<?php echo $image; ?>" class="profileImg circle" width="300px" height="300px" alt="Profile">
      <p class="center"><a href="#picupload" class="modal-trigger">Edit Image</a></p>
      <!-- Modal Structure -->
      <div id="picupload" class="modal">
        <div class="modal-content">
          <div class="row">
            <div class="col s2">
            </div>
            <div class="col s8">
              <form class="col s12" method="post" enctype="multipart/form-data">
                <div class="center" id="picview" style="height: 200px;">
                  <img src="../images/profile/<?php echo $image; ?>" style="height: 200px; width: 200px;">
                </div>
                <div class="file-field input-field">
                  <div class="btn">
                    <span>Image</span>
                    <input type="file" name="pic[]" onchange="preview_image();" id="pic">
                  </div>
                  <div class="file-path-wrapper">
                    <input class="file-path validate" type="text">
                  </div>
                </div>
                <input class="btn right" width="100%" type="submit" name="upload" value="UPLOAD">
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
      <h5 class="center"><?php echo $firstname. " " .$middlename. " " .$lastname; ?></h5>
    </div>
    <div class="col s12 m7">
      <p>Address: <u><?php echo $address; ?></u></p>
      <p>Date of birth: <u><?php echo $date_of_birth; ?></u></p>
      <p>Gender: <u><?php echo $gender; ?></u></p>
      <p>Contact Number: <u><?php echo $contactno; ?></u></p>
      <p>Email Address: <u><?php echo $emailadd; ?></u></p>
      <p>Account Type: <u><?php echo ucwords($type); ?></u></p>
      <?php
        $myProgress = getMyProgress();
        if(count($myProgress)>0) {
          $totalHours = $myProgress[0]['no_of_hours'];
          $myHours = $myProgress[0]['hours_done'];
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
      <?php
        }
        else {
          pr("<p class='red-text'>Not enrolled yet.</p>");
        }
      ?>
      <?php
        if($baseurl[1] == $_SESSION['ACCT_NO']){
        ?>
          <p><a href="/practicumhub/home/updateprofile/<?php pr($_SESSION['ACCT_NO']); ?>">Edit Profile</a></p>
        <?php
        }
      ?>
    </div>
  </div>
</div>
