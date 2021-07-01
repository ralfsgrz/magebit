<?php
/* 
    Execute this file in browser to create mysql database 
    with subscriptions table.
    Change connection data in "./db/database.php".
*/

require "./database.php";

$db = new Database();
$db->createDatabaseAndTable();

?>