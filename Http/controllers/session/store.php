<?php

use Core\App;
use Core\Database;
use Http\Forms\LoginForm;

$db = App::resolve(Database::class);

$form = new LoginForm();

if (!$form->validate($_POST['email'], $_POST['password'])) {

    view("session/create.view.php", [
        "errors" => $form->errors(),
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
