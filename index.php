<?php

declare(strict_types=1);

$email = "test1@gmail.com";
$password = "frjswen9";
$username = "Anton";

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
  </div>
</body>

</html>