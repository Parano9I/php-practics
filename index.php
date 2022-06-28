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
  ["name" => "Vlad", "email" => "vlad@gmail.com"],
  ["name" => "Anton", "email" => "anton3434@gmail.com"],
  ["name" => "Eduard", "email" => "edic8345@gmail.com"],
  ["name" => "Roman", "email" => "romaha234@gmail.com"],
  ["name" => "Rostik", "email" => "bugiman34@gmail.com"],
  ["name" => "Mike", "email" => "milki34@gmail.com"],
];

echo "Number of users ". count($users);

krsort($users);

$userWithMinId = $users[min(array_keys($users))];
$userWithMaxId = $users[max(array_keys($users))];

$userWithPreMaxId = $users[max(array_keys($users))-1];
$userWithAfterMinId = $users[min(array_keys($users))+1];


echo "<br>";
echo "<pre>";
  print_r($users);
echo "</pre>";


echo "<br>";
echo "<pre>";
  echo "userWithMinId";
  print_r($userWithMinId);
  echo "userWithMaxId";
  print_r($userWithMaxId);
  echo "userWithPreMaxId";
  print_r($userWithPreMaxId);
  echo "userWithAfterMinId";
  print_r($userWithAfterMinId);
echo "</pre>";

unset($users[min(array_keys($users))]);

echo "<pre>";
  echo "new array after unset method";
  print_r($users);
echo "</pre>";
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
          <option value="<?=$langCode; ?>">
            <?=$lang; ?>
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