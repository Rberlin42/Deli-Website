<?php
function openDatabaseConnection(){
  try{
    $dsn = "mysql:host=mariadb;dbname=deli";
    $duser = "root";
    $dpassword = "root";
    $connection = new PDO($dsn, $duser, $dpassword);
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  
    if(!isset($dname)) {
      $dname = 'deli';
    }
  
    // Selecting Database
    $connection->exec("USE `$dname`");
    
    return $connection;
  }catch(PDOException $e){
    echo $e;
    return null;
  }
}
?>