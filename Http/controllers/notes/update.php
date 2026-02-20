<?php

use Core\App;
use Core\Database;
use Core\Validator;

$db = App::resolve(Database::class);

$currentUserId = 1;

$note = $db->query("SELECT * FROM notes where id = :id", [
    'id' => $_POST['id']
])->findOrFail();

authorize($note['user_id'] === $currentUserId);

$body = trim($_POST['body']);
$errors = [];

if (!Validator::string($body, 1, 1000)) {
    $errors['body'] = "A body of note must be between 0 and 1000 characters.";
}

if (!empty($errors)) {

    view("notes/edit.view.php", [
        "heading" => "Edit Note",
        "errors" => $errors,
        "note" => $note
    ]);

    return;
}

$db->query("UPDATE notes SET body = :body where id = :id", [
    'body' => $body,
    'id' => $_POST['id']
]);

header("Location: /notes");
exit;