<?php

define('ROOT_PATH', dirname(__FILE__));
const SALT = '6834_@#%ghjtiodjkghjdlvbjg';

$isAuth = false;

function authLog (bool $isAuth, string $username):void {
    $filePath = ROOT_PATH . "/resources/{$username}.txt";
    $userLogFile = fopen($filePath, 'a+');
    $str = fgets($userLogFile);
    fclose($userLogFile);
    $good = 0;
    $err = 0;

    if ($str) {
        [$good, $err] = explode(' ', $str);
        $isAuth ? $good ++ : $err ++;
    } else {
        $isAuth ? $good = 1 : $err = 1;
    }

    $newStr = "{$good} {$err}" . PHP_EOL;
    $userLogFile = fopen($filePath, 'w+');
    fwrite($userLogFile, $newStr);
    fclose($userLogFile);
};

if (!empty($_POST)) {
    $cryptPass = crypt($_POST['password'], SALT);

    try{
        $userDataFile = fopen(ROOT_PATH . '/resources/usersData.txt', 'r');

        while (!feof($userDataFile)) {
            $str = fgets($userDataFile);
            $strFormated = str_replace(["\n", "\r"], '', $str);

            if (str_contains($str, $_POST['username'])) {
                [$name, $email, $pass] = explode(' ', $strFormated);
                $isAuth = hash_equals(crypt($_POST['password'], $pass), $pass);
                authLog($isAuth, $name);
                break;
            };
        };

        fclose($userDataFile);
    } catch (Exception $err) {
        echo 'Error ' . $err->getMessage();
    }
}

$message = $isAuth ? 'Successful authorization' : 'Wrong login or password';


?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="index.css">
  <title>Sign In</title>
</head>

<body>
  <div class="card">
    <h2 class="card-heading">
      Sign in
    </h2>
    <?php if ($isAuth): ?>
    <div class="auth-message" style="background-color: #578a4288;"><?php echo $_POST['username'] ?></div>
    <?php endif; ?>
    <?php if (!$isAuth && !empty($_POST)): ?>
    <div class="auth-message" style="background-color: #8a424288;">Wrong login or password</div>
    <?php endif; ?>
    <form class="card-form" method="POST">
      <div class="input">
        <input type="text" class="input-field" name="username" value="" required />
        <label class="input-label">Username</label>
      </div>
      <div class="input">
        <input type="password" class="input-field" name="password" required value="" />
        <label class="input-label">Password</label>
      </div>
      <div class="action">
        <input type="submit" value="Sign in" class="action-button" />
      </div>
    </form>
  </div>
</body>


</html>
