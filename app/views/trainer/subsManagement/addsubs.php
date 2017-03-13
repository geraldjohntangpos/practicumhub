<?php

  if(isset($_POST['addsubs'])) {
    $keygen = $_POST['keygen'];
    $startdate = $_POST['startdate'];
    $numofmonths = $_POST['numofmonths'];
    $postcount = $_POST['postcount'];
    $description = $_POST['description'];

    $arrayinfo = [$_SESSION['ACCT_NO'], $keygen, $startdate, $numofmonths, $description];

    addSubcriptionTrainer($arrayinfo, $postcount);
  }

?>
<div class="fixed-action-btn" style="bottom: 45px; right: 24px;">
  <a class="btn-floating btn-large #9a8989" href="/practicumhub/home/managesubs">
    <i class="large material-icons">clear</i>
  </a>
</div>
<div class="signin row container">
  <form class="col s12" method="post">
    <h4 class="center brown-text">Add Subscription Plan</h4>
    <div class="row">
      <div class="input-field col s12">
        <i class="material-icons prefix">vpn_key</i>
        <input id="keygen" type="text" name="keygen" value="<?php echo generateKeyGen(15); ?>" required readonly>
        <label for="keygen">Keygen</label>
      </div>
      <div class="input-field col s12">
        <input id="startdate" type="text" name="startdate" value="<?= concatDateWithTime(); ?>" required readonly>
        <label for="startdate">Start Date</label>
      </div>
      <div class="input-field col s12">
        <input id="numofmonths" type="number" name="numofmonths" min="1" value="1" required>
        <label for="numofmonths">Subscription span (months)</label>
      </div>
      <div class="input-field col s12">
        <input id="postcount" type="number" name="postcount" min="1" value="1" required>
        <label for="postcount">Number of Posts</label>
        <p class="blue-text">*20 Pesos rate per post.</p>
      </div>
      <div class="row">
        <div class="input-field col s12">
          <textarea id="description" class="materialize-textarea" name="description" length="255"></textarea>
          <label for="description">Description</label>
        </div>
      </div>
      <div class="right">
        <input class="btn" type="submit" value="Add Subscription" name="addsubs">
      </div>
    </div>
  </form>
</div>
