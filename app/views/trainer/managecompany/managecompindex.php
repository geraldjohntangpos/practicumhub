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
    $company_id = $_POST['company_id'];
    uploadLogoCompany($pic, $company_id);
  }

  if(isset($_POST['joinschool'])) {

  }

  $company = getMyCompany();
  if(count($company)>0) {
    foreach($company as $row) {
      $company_id = $row['company_id'];
      $company_name = $row['company_name'];
      $company_branch = $row['company_branch'];
      $company_address = $row['company_address'];
      $company_contact = $row['company_contact'];
      $image = $row['image'];
      $acct_no = $row['acct_no'];
      $partner_id = $row['partner_id'];
      $partner_key = $row['partner_key'];
    }
    ?>
    <!-- <div class="fixed-action-btn" style="bottom: 45px; right: 24px;">
      <a class="btn-floating btn-large #9a8989">
        <i class="large material-icons">add</i>
      </a>
      <ul>
        <li><a class="btn-floating #9a8989 tooltipped" data-position="left" data-delay="50" data-tooltip="Leave School" href="/practicumhub/home/addpartner/school">S</a></li>
        <li><a class="btn-floating #9a8989 tooltipped" data-position="left" data-delay="50" data-tooltip="Add Company" href="/practicumhub/home/addpartner/company">C</a></li>
      </ul>
    </div> -->
    <div class="container">
      <div class="profilebody row">
        <div class="col s12 m5">
          <img src="../images/company/<?php pr($image); ?>" class="profileImg responsive-img" alt="Hipster">
            <p class="center"><a href="#picupload" class="modal-trigger">Edit Image</a></p>
            <!-- Modal Structure -->
            <div id="picupload" class="modal">
              <div class="modal-content">
                <div class="row">
                  <div class="col s2">
                  </div>
                  <div class="col s8">
                    <form class="col s12" method="post" enctype="multipart/form-data">
                      <div class="input-field col s12">
                        <input id="company_id" type="number" name="company_id" value="<?php pr($company_id); ?>" readonly required>
                        <label for="company_id">Company ID</label>
                      </div>
                      <div class="center" id="picview" style="height: 200px;">
                        <img src="../images/company/<?php echo $image; ?>" style="height: 200px; width: 200px;">
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
          <h5 class="center"><?php pr($company_name); ?> <a href="#" class="dropdown-button" data-activates='editlistschool'><i class="material-icons">mode_edit</i></a></h5>
        </div>

        <div class="col s12 m7">
          <p>Branch: <u><?php pr($company_branch); ?></u></p>
          <p>Address: <u><?php pr($company_address); ?></u></p>
          <p>Contact Number: <u><?php pr($company_contact); ?></u></p>
          <p>Company Access Key: <u><?php pr($partner_key); ?></u></p>
        </div>
      </div>
    </div>
    <?php
  }
  else {
    ?>
    <div class="container">
      <div class="row">
        <div class="col s12 m12">
          <div class="card">
            <div class="card-content">
              <h5 class="center">You don't belong to any school.</h5>
            </div>
            <div class="card-action">
              <a href="/practicumhub/home/addschool">Add School</a>
              <a href="/practicumhub/home/joinschool">Join Existing</a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php
  }

?>
