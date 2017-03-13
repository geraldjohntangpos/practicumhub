<?php

  if(isset($_POST['updateprofile'])) {
    $firstname = $_POST['firstname'];
    $middlename = $_POST['middlename'];
    $lastname = $_POST['lastname'];
    $address = $_POST['address'];
    $birthdate = $_POST['birthdate'];
    $gender = $_POST['gender'];
    $contactno = $_POST['contactno'];
    $emailadd = $_POST['emailadd'];

    $data = array($firstname, $middlename, $lastname,
                  $address, $birthdate, $gender,
                  $contactno, $emailadd, $_SESSION['ACCT_NO']);
    updateBasic($data);
  }

  $acctProfile = getAcctInfo(array($_SESSION['ACCT_NO']));
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
?>
<div class="fixed-action-btn" style="bottom: 45px; right: 24px;">
  <a class="btn-floating btn-large #9a8989 tooltipped" data-position="left" data-delay="50" data-tooltip="Cancel" href="/practicumhub/home">
    <i class="large material-icons">clear</i>
  </a>
</div>
<div class="container">
  <div class="profilebody row">
    <div class="col s12 m5">
      <img src="../../images/profile/<?php echo $image; ?>" class="profileImg responsive-img circle" alt="Hipster">
    </div>
    <div class="col s12 m7">
      <div class="row">
        <form class="col s12" method="post">
          <div class="input-field col s12">
            <input id="firstname" type="text" name="firstname" value="<?php pr($firstname); ?>" required>
            <label for="firstname">First Name</label>
          </div>
          <div class="input-field col s12">
            <input id="middlename" type="text" name="middlename" value="<?php pr($middlename); ?>" required>
            <label for="middlename">Middle Name</label>
          </div>
          <div class="input-field col s12">
            <input id="lastname" type="text" name="lastname" value="<?php pr($lastname); ?>" required>
            <label for="lastname">Last Name</label>
          </div>
          <div class="input-field col s12">
            <input id="address" type="text" name="address" value="<?php pr($address); ?>" required>
            <label for="address">Address</label>
          </div>
          <div class="input-field col s12">
            <input id="birthdate" type="date" class="datepicker" name="birthdate" value="<?php pr($date_of_birth); ?>" required>
            <label for="birthdate">Date of Birth</label>
          </div>
          <div class="input-field col s12">
            <p>Gender: </p>
            <input id="male" type="radio" class="with-gap" name="gender" value="Male" required
              <?php
                if($gender == "Male") {
                  pr('checked');
                }
              ?>
            >
            <label for="male">Male</label>
            <input id="female" type="radio" class="with-gap" name="gender" value="Female" required
              <?php
                if($gender == "Female") {
                  pr('checked');
                }
              ?>
            >
            <label for="female">Female</label>
          </div>
          <div class="input-field col s12">
            <input id="contactno" type="text" class="validate" name="contactno" value="<?php pr($contactno); ?>" required>
            <label for="contactno">Contact +639*********</label>
          </div>
          <div class="input-field col s12">
            <input id="emailadd" type="email" class="validate" name="emailadd" value="<?php pr($emailadd); ?>" required>
            <label for="emailadd">Email Address</label>
          </div>
          <div class="center">
            <input class="btn" type="submit" value="Submit" name="updateprofile">
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
