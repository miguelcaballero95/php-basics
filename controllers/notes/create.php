<?php

use Core\Database;
use Core\Validator;

$config = require base_path("config.php");
$db = new Database($config['database']);

$errors = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $body = trim($_POST['body']);

    if (!Validator::string($body, 1, 1000)) {
        $errors['body'] = "A body of note must be between 0 and 1000 characters.";
    }

    if (empty($errors)) {
        $db->query("INSERT INTO notes (body, user_id) VALUES (:body, :user_id)", [
            'body' => $body,
            'user_id' => 1
        ]);

        header("Location: /notes");
        exit;
    }
}


view("notes/create.view.php", [
    "heading" => "Create Note",
    "errors" => $errors
]);