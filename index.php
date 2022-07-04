<?php

declare(strict_types=1);
mb_internal_encoding('utf-8');

$email = 'test1@gmail.com';
$password = 'frjswen9';
$username = 'Anton';

$lang =	[
    'ua' => 'Ukraine',
    'en' => 'English',
    "es" => 'Espanol',
];

$users = [
    '40' => ['name' => 'Vlad', 'email' => 'vlad@gmail.com', 'lang' => 'fr'],
    '2' => ['name' => 'Anton', 'email' => 'anton3434@gmail.com', 'lang' => 'fr'],
    '0' => ['name' => 'Eduard', 'email' => 'edic8345@gmail.com', 'lang' => 'en'],
    '29' => ['name' => 'Anton', 'email' => 'romaha234@gmail.com', 'lang' => 'fr'],
    '18' => ['name' => 'Rostik', 'email' => 'bugiman34@gmail.com', 'lang' => 'de'],
    '6' => ['name' => 'Vlad', 'email' => 'milki34@gmail.com', 'lang' => 'de'],
];



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
    <form class="card-form">
      <div class="input">
        <input type="text" class="input-field" value="<?php echo $username ?>" required />
        <label class="input-label">Username</label>
      </div>
      <div class="input">
        <input type="text" class="input-field" value="<?php echo $email ?>" required />
        <label class="input-label">Email</label>
      </div>
      <div class="input">
        <input type="password" class="input-field" required value="<?php echo $password ?>" />
        <label class="input-label">Password</label>
      </div>
      <div class="action">
        <button class="action-button">Sign up</button>
      </div>
    </form>
    <p class="signin-link">
      If already registered —
      <a href="/signin.php" class="signin-link__link">Sign in</a>
    </p>
  </div>
</body>

</html>
