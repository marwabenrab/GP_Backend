<?php

/*
$dsn = "mysql:host=localhost;dbname=falahdatabase";
$user = "root" ;
$pass = ""  ;

$option = array( 

      PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES UTF8 "
);
            try{

            $con = new PDO($dsn , $user , $pass , $option ) ;
            $con->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION) ;

      }
            catch(PDOException $e){
            echo $e-> getMessage();

}
*/
/*$dsn = "fdb1032.awardspace.net";
$db = "4487784_fellah";                  
$user = "4487784_fellah" ;
$pass = "marwa2002ben"  ; */

$dsn = "localhost";
$db = "falahdatabase";  
$user = "root" ;                
$pass = "" ;


// Create connection
$con = new mysqli($dsn, $user, $pass, $db);

// Check connection
if ($con->connect_error) {  die("Connection failed: " . $con->connect_error);
}

