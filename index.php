<?php

declare(strict_types=1);

$email = "test1@gmail.com";
$password = "frjswen9";
$username = "Anton";

$langs = [
  "ua" => "Ukraine",
  "en" => "English",
  "es" => "Espanol",
];

$users = [
  "40" => ["name" => "Vlad", "email" => "vlad@gmail.com", "lang" => "fr"],
  "2" => ["name" => "Anton", "email" => "anton3434@gmail.com", "lang" => "ru"],
  "0" => ["name" => "Eduard", "email" => "edic8345@gmail.com", "lang" => "en"],
  "29" => ["name" => "Roman", "email" => "romaha234@gmail.com", "lang" => "fr"],
  "18" => ["name" => "Rostik", "email" => "bugiman34@gmail.com", "lang" => "de"],
  "6" => ["name" => "Mike", "email" => "milki34@gmail.com", "lang" => "de"],
];

$date = "31-12-2020";
$formatedDate = implode(".",array_reverse(explode("-", $date)));

echo $formatedDate;

$englishLeasonTitle = "london is the capital of great britain";
$formatedEnglishLeasonTitle = ucwords($englishLeasonTitle);

echo "<br>";
echo $formatedEnglishLeasonTitle;

$password = "gfg4@_d#dfd";
$passLength = strlen($password);

echo "<br>";
echo $passLength > 7 && $passLength < 12 
  ? "Password is good !" 
  : "Password is bad ! Create a new password !";

$string = "1a2b3c4b5d6e7f8g9h0";

echo "<br>";
echo preg_replace("/[0-9]+/", "", $string); 

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
      <div class="input">
        <select class="input-field" name="langs" required>
          <?php foreach($langs as $langCode => $lang):?>
          <option value="<?php echo $langCode; ?>">
            <?php echo $lang; ?>
          </option>
          <?php endforeach; ?>
        </select>
        <label class="input-label">Change language</label>
      </div>
      <div class="action">
        <button class="action-button">Sign up</button>
      </div>
    </form>
  </div>
</body>

</html>