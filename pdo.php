<?php
$pdo = new PDO('mysql:host=hostname;port=3306(IT MAY VARY SO PLEASE CHECK);dbname=database_name', 
   'username', 'password');
// See the "errors" folder for details...
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);



