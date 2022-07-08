<?php
include_once 'config.php';
include_once 'helpers/getUsers.php';
include_once 'helpers/fillterByField.php';

$users = getUsers(ROOT_PATH . '/resources/usersData.txt');

echo '<pre>';
print_r(fillterByField($users, 'password', function($pass){
    return strlen($pass) < 8 ? true : false;
}));
echo '</pre>';

var_dump(findUser($users, ['Romaha@48', 't_483xN']));

include_once 'Views/signUp.php';
