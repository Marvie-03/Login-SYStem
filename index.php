<?php 


session_start();

if(isset($_SESSION['user_id'])){

$mysqli = require __DIR__ . '/databse.php';

$sql = "SELECT * FROM user
        WHERE id = {$_SESSION["user_id"]}";


$result = $mysqli->query($sql);
$user = $result->fetch_assoc();
}

require 'templates/header.php';

?>
<h1> Home </h1>
<?php if(isset($user)): ?>
    <p>Hello <?= htmlspecialchars($user['name']) ?></p>
    <p><a href="logout.php">Log out</a></p>
<?php else: ?>
    <p><a href="login.php">Login</a> or <a href="signup.php">Sign Up</a></p>
<?php endif; ?>

</body>
</html>