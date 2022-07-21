<?php
include_once 'config.php';

$errorMsg = '';

if (!empty($_POST)) {
    $data = [
        'username' => $_POST['username'],
        'email' => $_POST['email'],
        'password' => password_hash($_POST['password'], PASSWORD_DEFAULT),
    ];
    $payload = json_encode($data);

    $ch = curl_init('http://api.loc');
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = json_decode(curl_exec($ch), true);
    curl_close($ch);

    if ($response['status'] === 200) {
        header('Location: /signin.php');
    } else $errorMsg = $response['message'];
}


include_once 'Views/signUp.php';
