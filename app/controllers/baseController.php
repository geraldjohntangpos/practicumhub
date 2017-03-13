<?php

  require_once('adminController.php');

  /**
   *
   */
class BaseController {

    function __construct() {
    }

    public static function control($class, $func) {
      $class::$func();
    }
  }

  $controller = new BaseController();

?>
