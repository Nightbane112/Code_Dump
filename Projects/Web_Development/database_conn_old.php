<?php
   $dbConn = new mysqli('localhost', 'USER', 'PSWD', 'DB_NAME');

   if ($dbConn->connect_error) {
      echo "<p>Connection failed: ".$dbConn->connect_error."</p>\n";
      exit;
   }
?>
