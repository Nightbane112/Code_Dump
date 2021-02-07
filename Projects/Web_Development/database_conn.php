 <?php
   $server = "localhost";
   $username = "user";
   $password = "";
   $db = "myDB";
   
   $dbConn = new mysqli($server, $username, $password, $db);

   if ($dbConn->connect_error) {
      echo "<p>Connection failed: ".$dbConn->connect_error."</p>\n";
      exit;
   }
?>
