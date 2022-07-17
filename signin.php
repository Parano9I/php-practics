<?php
include_once 'config.php';

$errorMsg = '';

if (!empty($_POST)) {
    $data = [
        'username' => $_POST['username'],
        'password' => $_POST['password'],
    ];
    $payload = json_encode($data);

    $ch = curl_init('http://api.loc/signin.php');
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = json_decode(curl_exec($ch), true);
    curl_close($ch);

    if ($response['status'] === 200) {
        $_SESSION['userId'] = $response['userId'];
        if (isset($_POST['remember'])) {
            setcookie("userId", $response['userId'], time() + 3600);
        };
        header('Location: /products.php');
    } else $errorMsg = $response['message'];
}

// if (!empty($_POST)) {
//     $users = json_decode(file_get_contents(USERS_JSON_PATH), true);
//     $postPassword = $_POST['password'];
//     $user = [...array_filter($users, function ($user) use ($postPassword) {
//         $isVerifyLogin = ($user['username'] === $_POST['username']);
//         $isVerifyPass = (password_verify($postPassword, $user['password']));

//         return $isVerifyLogin && $isVerifyPass;
//     })];

//     if (!empty($user)) {
//         $userId = $user[0]['id'];
//         $_SESSION['userId'] = $userId;
//         if (!empty($_POST['remember'])) {
//             setcookie("userId", $userId, time() + 3600);
//         }
//         echo 'true';
//         // header('Location: /products.php');
//     } else {
//         $errorMsg = 'Wrong login or password';
//     }
// }

include_once 'Views/signIn.php';
