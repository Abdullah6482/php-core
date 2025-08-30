<?php


use Core\App;
use Core\Database;

$db = App::resolve(Database::class);

$user_id = currentUserId($db);

$note = $db->query('select * from notes where id = :id', [
    'id' => $_GET['id']
])->findOrFail();

authorize($note['user_id'] === $user_id);

$db->query('DELETE FROM notes WHERE id = :id', [
    'id' => $_POST['id']
]);

header('Location: /notes');
exit;


