<?php
include_once '../config.php';
include_once '../helpers/addToJSON.php';

if (!file_exists(USERS_JSON_PATH)) {
    $usersFile = fopen(USERS_JSON_PATH, 'a');
    fwrite($usersFile, json_encode([]));
    fclose($usersFile);
}

$response = [];

$postData = json_decode(file_get_contents('php://input'), true);
$usersJSON = file_get_contents(USERS_JSON_PATH);
if (!str_contains($usersJSON, $postData['email']) && !str_contains($usersJSON, $postData['username'])) {
    $userId = uniqid();
    $user = [
        'id' => $userId,
        'username' => $postData['username'],
        'email' => $postData['email'],
        'password' => $postData['password'],
    ];
    file_put_contents(USERS_JSON_PATH, addToArrJSON($usersJSON, $user));
    $response = [
        'status' => 200,
        'message' => null,
    ];
} else {
    $response = [
        'status' => 400,
        'message' => 'This email or username is already registered',
    ];
}

echo json_encode($response);
