<?php error_reporting(0);
if(file_exists('./install/'))
{
  //Include Site variables
  include('./global/variables/variables.php');
  //Include Site Install
  include('./install/index.php');
}
else
{
  //Include Site Config
  include('./global/config/config.php');
  //Include Site variables
  include('./global/variables/variables.php');
  //Include Site BBCode
  include('./includes/bb.php');
  //Include Site Template
  include('./includes/template.php');
  //Include Site Functions
  include('./includes/functions.php');
  //Include Site Replace
  include('./includes/replace.php');
}
?>