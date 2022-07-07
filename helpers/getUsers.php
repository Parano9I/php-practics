<?php

function getUsers(string $filePath):array {
    $result = [];
    $userKeys = [
        'name',
        'login',
        'password',
        'email',
        'lang',
    ];

    $usersDataFile = fopen($filePath, 'r');
    while (!feof($usersDataFile)) {
        $str = fgets($usersDataFile);
        $formatedStr = str_replace(["\n", "\r"], '', $str);
        if ($formatedStr) {
            $fields = explode(' ', $formatedStr);
        } else continue;
        $userData = array_combine($userKeys, $fields);
        array_push($result, $userData);
    };
    fclose($usersDataFile);
    return $result;
};
