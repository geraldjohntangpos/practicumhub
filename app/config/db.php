<?php
  //this function is the connection to the database.
  //I used PDO instead of mysql.
  function dbconn() {
    return new PDO("mysql:host=localhost;dbname=phub", 'root', '');
  }

  //include all the models that are used.
  //the models are used to for the CRUD in each module.
  require_once('app/models/checkAcctModel.php');
  require_once('app/models/registrationModel.php');
  require_once('app/models/signinModel.php');
  require_once('app/models/subsModel.php');
  require_once('app/models/adminModel.php');
  require_once('app/models/practprogModel.php');
  require_once('app/models/classModel.php');
  require_once('app/models/partnersModel.php');
  require_once('app/models/profileModel.php');
  require_once('app/models/deptadminModel.php');
  require_once('app/models/schoolModel.php');
  require_once('app/models/departmentModel.php');
  require_once('app/models/studentModel.php');
  require_once('app/models/jobModel.php');
  require_once('app/models/companyModel.php');
  require_once('app/models/requestModel.php');
  require_once('app/models/internModel.php');
  require_once('app/models/dtrModel.php');
  require_once('app/models/imageModel.php');

?>
