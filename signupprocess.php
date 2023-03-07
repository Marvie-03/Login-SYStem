<?php
$err = "";

if(empty($_POST['name'])){
    die('Name is required');
}

mysqli_report(MYSQLI_REPORT_OFF);
if(! filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
    die('valid email is required');
}

if(strlen($_POST['password'])<8){
    die('passsword must be atleast 8 Characters');
}
if( ! preg_match('/[a-z]/i', $_POST['password'])){
    die('password must contain at least one letter');
}
if( ! preg_match('/[0-9]/', $_POST['password'])){
    die('password must contain at least one number');
}
if($_POST['password'] !== $_POST['re-password']){
    $err = 'passwords must match';
}

$password_hash= password_hash($_POST['password'], PASSWORD_DEFAULT);

$mysqli = require __DIR__ . '/databse.php';

$sql = 'INSERT INTO user (name, email, password_hash )
        VALUES (?,?,?)';

$stmt = $mysqli -> stmt_init();

if(! $stmt->prepare($sql)){
    die('SQL Error: '. $mysqli->error);
}
 $stmt->bind_param('sss',
                    $_POST['name'],
                    $_POST['email'],
                    $password_hash);

if ($stmt->execute()) {
   header("Location: signupsucess.php");
   exit;
}
else{

    if($mysqli->errno === 1062){
        die('email is Already taken');
    } else{
    die( $mysqli->error . ' '. $mysqli->errno);
    }
}



?>