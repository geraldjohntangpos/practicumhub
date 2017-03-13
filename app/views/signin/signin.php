<?php
  if(isset($_POST['signin'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $arrayInfo = [$username, $password];
    signin($arrayInfo);
  }
?>

<div class="signin row container z-depth-5">
  <form class="col s12" method="post">
    <h4 class="center brown-text">SIGN IN</h4>
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
      <div class="right">
        <input class="btn" type="submit" value="SIGN IN" name="signin">
      </div>
    </div>
  </form>
</div>
