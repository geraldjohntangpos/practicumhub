<?php

  if(isset($_POST['addsubs'])) {
    $subplan_no = $_POST['subplan_no'];
    $description = $_POST['description'];

    $arrayinfo = [$description, $subplan_no];

    updateSub($arrayinfo);
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
        <input id="keygen" type="text" name="keygen" value="<?php echo $keygen; ?>" required readonly>
        <label for="keygen">Keygen</label>
      </div>
      <div class="input-field col s12">
        <input id="subplan_no" type="text" name="subplan_no" value="<?php echo $subplan_no; ?>" required readonly>
        <label for="subplan_no">Subplan ID</label>
      </div>
      <div class="row">
        <div class="input-field col s12">
          <textarea id="description" class="materialize-textarea" name="description" length="255"><?php echo $description; ?></textarea>
          <label for="description">Description</label>
        </div>
      </div>
      <div class="right">
        <input class="btn" type="submit" value="Update Subscription" name="addsubs">
      </div>
    </div>
  </form>
</div>
