<?php

use Core\App;
use Core\Database;
use Core\Validator;

$db = App::resolve(Database::class);

$body = trim($_POST['body']);
$errors = [];

if (!Validator::string($body, 1, 1000)) {
    $errors['body'] = "A body of note must be between 0 and 1000 characters.";
}

if (!empty($errors)) {

    view("notes/create.view.php", [
        "heading" => "Create Note",
        "errors" => $errors
    ]);

    return;
}

$db->query("INSERT INTO notes (body, user_id) VALUES (:body, :user_id)", [
    'body' => $body,
    'user_id' => 1
]);

header("Location: /notes");
exit;