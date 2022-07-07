<?php
declare(strict_types=1);
mb_internal_encoding('utf-8');

include 'helpers/getUsers.php';
include 'helpers/fillterByField.php';

define('ROOT_PATH', dirname(__FILE__));

$users = getUsers(ROOT_PATH . '/resources/usersData.txt');

echo '<pre>';
print_r(fillterByField($users, 'password', function($pass){
    return strlen($pass) < 8 ? true : false;
}));
echo '</pre>';

var_dump(findUser($users, ['Romaha@48', 't_483xN']));


?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="index.css">
  <title>SignUp</title>
</head>

<body>
  <div class="card">
    <h2 class="card-heading">
      Sign up
    </h2>
    <form class="card-form" name="signin" method="POST">
      <div class="input">
        <input name="username" type="text" class="input-field"
          value="<?php echo !empty($_POST['username']) ? $_POST['username'] :'' ?>" required />
        <label class="input-label">Username</label>
      </div>
      <div class="input">
        <input name="email" type="text" class="input-field"
          value="<?php echo !empty($_POST['email']) ? $_POST['email'] : '' ?>" required />
        <label class="input-label">Email</label>
      </div>
      <div class="input">
        <input name="password" type="password" class="input-field" value="" required />
        <label class="input-label">Password</label>
      </div>
      <div class="action">
        <input type="submit" value="Sign up" class="action-button">
      </div>
    </form>
    <p class="signin-link">
      If already registered —
      <a href="/signin.php" class="signin-link__link">Sign in</a>
    </p>
  </div>
</body>


</html>
