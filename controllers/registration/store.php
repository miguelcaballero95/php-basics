<?php

use Core\App;
use Core\Database;
use Core\Validator;

$email = $_POST["email"];
$password = $_POST["password"];

if (!Validator::email($email)) {
    $errors['email'] = "Email is not valid";
}

if (!Validator::string($password, 8, 255)) {
    $errors['password'] = "Password must be at least 8 characters";
}

if (!empty($errors)) {
    view("registration/create.view.php", [
        "errors" => $errors
    ]);
    return;
}

$db = App::resolve(Database::class);

$user = $db->query("SELECT * FROM users WHERE email = :email", [
    "email" => $email
])->find();

if ($user) {
    header("location: /");
    exit;
} else {
    $db->query("INSERT INTO users (email, password) VALUES (:email, :password)", [
        "email" => $email,
        "password" => password_hash($password, PASSWORD_BCRYPT)
    ]);

    $_SESSION["user"] = [
        "email" => $email
    ];

    header("location: /");
    exit;
}