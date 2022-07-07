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

include_once 'Views/signUp.php';
