<?php
  if(isset($_POST['register'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $firstname = $_POST['firstname'];
    $middlename = $_POST['middlename'];
    $lastname = $_POST['lastname'];
    $address = $_POST['address'];
    $birthdate = $_POST['birthdate'];
    $gender = $_POST['gender'];
    $contact = $_POST['contact'];
    $email = $_POST['email'];
    $type = 'trainer';
    $arrayInfo = [
      $username, $password, $firstname, $middlename, $lastname,
      $address, $birthdate, $gender, $contact, $email, $type
    ];
    basicRegistration($arrayInfo);
  }
?>

<div class="signin row container z-depth-5">
  <form class="col s12" method="post">
    <h4 class="center brown-text">REGISTER AS TRAINER</h4>
    <div class="row">
      <div class="input-field col s12">
        <i class="material-icons prefix">account_circle</i>
        <input id="username" type="text" class="validate" name="username" required>
        <label for="username">User Name</label>
      </div>
      <div class="input-field col s12">
        <i class="material-icons prefix">vpn_key</i>
        <input id="password" type="password" class="validate" name="password" required>
        <label for="password">Password</label>
      </div>
      <hr class="brown-text">
      <div class="input-field col s12">
        <input id="firstname" type="text" class="validate" name="firstname" required>
        <label for="firstname">First Name</label>
      </div>
      <div class="input-field col s12">
        <input id="middlename" type="text" class="validate" name="middlename" required>
        <label for="middlename">Middle Name</label>
      </div>
      <div class="input-field col s12">
        <input id="lastname" type="text" class="validate" name="lastname" required>
        <label for="lastname">Last Name</label>
      </div>
      <div class="input-field col s12">
        <input id="address" type="text" class="validate" name="address" required>
        <label for="address">Address</label>
      </div>
      <div class="input-field col s12">
        <input id="birthdate" type="date" class="datepicker" name="birthdate" required>
        <label for="birthdate">Date of Birth</label>
      </div>
      <div class="input-field col s12">
        <p>Gender: </p>
        <input id="male" type="radio" class="with-gap" name="gender" value="Male" required>
        <label for="male">Male</label>
        <input id="female" type="radio" class="with-gap" name="gender" value="Female" required>
        <label for="female">Female</label>
      </div>
      <div class="input-field col s12">
        <input id="contact" type="text" class="validate" name="contact" required>
        <label for="contact">Contact +639*********</label>
      </div>
      <div class="input-field col s12">
        <input id="email" type="email" class="validate" name="email" required>
        <label for="email">Email Address</label>
      </div>
      <div class="right">
        <input class="btn" type="submit" value="REGISTER" name="register">
      </div>
    </div>
  </form>
</div>
