<?php
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
        <input id="startdate" type="date" class="datepicker" name="startdate" required>
        <label for="startdate">Start Date</label>
      </div>
      <div class="input-field col s12">
        <input id="numofmonths" type="number" name="numofmonths" min="1" required>
        <label for="numofmonths">Subscription span (months)</label>
      </div>
      <div class="row">
        <div class="input-field col s12">
          <textarea id="description" class="materialize-textarea" length="255"></textarea>
          <label for="description">Description</label>
        </div>
      </div>
      <div class="right">
        <input class="btn" type="submit" value="Add Subscription" name="addsubs">
      </div>
    </div>
  </form>
</div>
