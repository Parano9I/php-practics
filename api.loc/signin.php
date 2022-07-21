<?php
include_once '../config.php';

$response = [];

$postData = json_decode(file_get_contents('php://input'), true);
$users = json_decode(file_get_contents(USERS_JSON_PATH), true);
$user = [...array_filter($users, function ($user) use ($postData) {
    $isVerifyLogin = ($user['username'] === $postData['username']);
    $isVerifyPass = (password_verify($postData['password'], $user['password']));

    return ($isVerifyLogin && $isVerifyPass);
})];

if (!empty($user)) {
    $userId = $user[0]['id'];
    $response = [
        'status' => 200,
        'userId' => $userId,
    ];
} else {
    $response = [
        'status' => 400,
        'message' => 'Wrong login or password',
    ];
}

echo json_encode($response);
