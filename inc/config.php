<?php
    
define('DBServer','localhost');
define('DBUsername','root');
define('DBPassword','12345678');
define('Database','social');

$link = mysqli_connect(DBServer, DBUsername, DBPassword, Database);
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>
