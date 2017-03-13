<?php
  require_once('app/start.php');
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Practicum Hub</title>
    <link rel="shortcut icon" type="image" href="<?= $bases; ?>images/icon.PNG" />
    <link href="<?php echo $bases; ?>plugins/icons/icons.css" rel="stylesheet">
    <link href="<?php echo $bases; ?>plugins/css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
    <link href="<?php echo $bases; ?>plugins/css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
    <!-- <script src="plugins/js/jquery.js"></script>
    <script src="plugins/js/myjs.js"></script> -->
  </head>
  <body>
    <header>

    </header>
    <main>
      <?php
        require_once('app/routes.php');
      ?>
    </main>
    <footer class="page-footer teal">
      <?php
        require_once('app/views/footer.php');
      ?>
    </footer>

    <!--  Scripts-->
    <!-- <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script> -->
    <script src="<?php echo $bases; ?>plugins/js/jquery.js"></script>
    <script src="<?php echo $bases; ?>plugins/js/materialize.js"></script>
    <script src="<?php echo $bases; ?>plugins/js/materialize2.js"></script>
    <script src="<?php echo $bases; ?>plugins/js/init.js"></script>
    <script src="<?php echo $bases; ?>plugins/js/myjs.js"></script>
    <script src="<?php echo $bases; ?>plugins/js/jquery.validate.js"></script>
    <script src="<?php echo $bases; ?>plugins/js/registerRules.js"></script>
    <script src="<?= $bases; ?>plugins/js/jquery.form.js"></script>
  </body>
</html>
