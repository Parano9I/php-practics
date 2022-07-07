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

function findUser(array $users, array $findParams): array|string{
    $result = [];
    foreach ($users as $user) {
        $userValues = array_values($user);
        if (in_array($findParams[0], $userValues) && in_array($findParams[1], $userValues)) {
            $result = [
                'login' => $user['login'],
                'password' => $user['password'],
            ];
            break;
        };
    };
    return $result = $result ? $result : 'User is not found';
}
