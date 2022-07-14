<?php
include_once 'config.php';
include_once 'helpers/getUsers.php';
include_once 'helpers/fillterByField.php';
include_once 'helpers/addToJSON.php';

$errorMsg = '';

if (!file_exists(USERS_JSON_PATH)) {
    $usersFile = fopen(USERS_JSON_PATH, 'a');
    fwrite($usersFile, json_encode([]));
    fclose($usersFile);
}
if (!empty($_POST)) {
    $usersJSON = file_get_contents(USERS_JSON_PATH);
    if (!str_contains($usersJSON, $_POST['email']) && !str_contains($usersJSON, $_POST['username'])) {
        $userId = uniqid();
        $user = [
            'id' => $userId,
            'username' => $_POST['username'],
            'email' => $_POST['email'],
            'password' => password_hash($_POST['password'], PASSWORD_DEFAULT),
        ];
        file_put_contents(USERS_JSON_PATH, addToArrJSON($usersJSON, $user));
        header('Location: /signin.php');
    } else {
        $errorMsg = 'This email or username is already registered';
    }
}


include_once 'Views/signUp.php';
