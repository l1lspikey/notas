<?php

use Spikey\Notas\models\Note;

if (count($_POST) > 0) {
    $title = $_POST['title'] ?? '';
    $content = $_POST['content'] ?? '';

    $note = new Note($title, $content);
    $note->save();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>CREATE NOTE</h1>
    <form action="?view=create" method="POST">
        <input type="text" name="title" placeholder="Title...">
        <br>
        <textarea name="content" id="" cols="30" rows="10"></textarea>

        <input type="submit" value="Create note" />
    </form>
</body>

</html>