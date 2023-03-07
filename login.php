<?php 

require 'templates/header.php';
$is_invalid = false;
if($_SERVER['REQUEST_METHOD']==='POST'){

  $mysqli = require __DIR__ . '/databse.php';

  $sql =sprintf('SELECT * FROM user
                WHERE email ="%s"',
               $mysqli->real_escape_string( $_POST['email']));
  
  $result = $mysqli->query($sql);
  
  $user = $result->fetch_assoc();

  if($user){

   if( password_verify($_POST['pswd'], $user['password_hash'])){
    session_start();
    session_regenerate_id();
    $_SESSION['user_id'] = $user['id'];
    header('Location: index.php');
    exit;
   }

  }
  $is_invalid =true;
}

?>

    <title>Bootstrap</title>
</head>
<body>
    <div class="container">
        <h1 class="center-text">Login Page</h1>
        <?php if ($is_invalid): ?>
          <em>Invalid login</em>
        <?php endif; ?>
        <form action="" class="container" method="post">
            <div class="mb-3 mt-3">
                <label for="email" class="form-label">Email:</label>
                <input type="email" class="form-control" id="email" placeholder="Enter email" name="email"
                value="<?= htmlspecialchars($_POST['email'] ?? "" ) ?>">
              </div>
              <div class="mb-3">
                <label for="pwd" class="form-label">Password:</label>
                <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="pswd">
              </div>
              <div class="form-check mb-3">
                <label class="form-check-label">
                  <input class="form-check-input" type="checkbox" name="remember"> Remember me
                </label>
              </div>
              <div class="col-6-md">
              <p>Don't have an account?<a href="signup.php"> <i class="fa fa-sign-in" aria-hidden="true"> Sign up</i></a></p>
              </div>
              <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
    
</body>
</html>