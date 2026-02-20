<?php

use Core\App;
use Core\Database;
use Core\Validator;

$db = App::resolve(Database::class);

$errors = [];

if (!Validator::email($_POST['email'])) {
    $errors['email'] = "Email is not valid";
}

if (!Validator::string($_POST['password'])) {
    $errors['password'] = "Password is not valid";
}

if (!empty($errors)) {
    view("session/create.view.php", [
        "errors" => $errors
    ]);
    return;
}

$user = $db->query("SELECT * FROM users WHERE email = :email", [
    "email" => $_POST["email"]
])->find();


if ($user && password_verify($_POST["password"], $user["password"])) {
    login($user);
    header("location: /");
    exit;
}

view("session/create.view.php", [
    "errors" => [
        "email" => "Not match email or password"
    ]
]);
