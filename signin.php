<?php
include_once 'config.php';

$isAuth = false;

function authLog(bool $isAuth, string $username): void
{
    $filePath = ROOT_PATH . "/resources/{$username}.txt";
    $userLogFile = fopen($filePath, 'a+');
    $str = fgets($userLogFile);
    fclose($userLogFile);
    $good = 0;
    $err = 0;

    if ($str) {
        [$good, $err] = explode(' ', $str);
        $isAuth ? $good++ : $err++;
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

    try {
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

include_once 'Views/signIn.php';
