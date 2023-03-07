<?php 

$host ='localhost';
$dbname = 'login_db';
$username = 'admin';
$password = '123456';

#Database connection
$mysqli = new mysqli( $host, $username,$password,$dbname);
if($mysqli->connect_errno){
    die('Connection error:' . $mysqli->connect_error);
}
 return $mysqli;
?>