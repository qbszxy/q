<?php
  define('DB_SERVER','localhost');
//  define('DB_SERVER','47.93.232.118');
  define('DB_USER','root');
  define('DB_PASS' ,'root');
  define('DB_NAME', 'gfactorial');
  $con = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);

  // Check connection
  if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
?>

