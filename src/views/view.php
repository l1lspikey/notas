<?php 
use Spikey\Notas\models\Note;
if (isset($_GET['id'])) {
    $note = Note::get($_GET['id']);
    
    if ($note === null) {
        // Si no se encuentra la nota, redirige o muestra un mensaje de error
        header('Location: http://localhost/notas/?view=home');
        exit;
    }

    // Verificar si la solicitud es POST en lugar de contar $_POST
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $title = $_POST['title'] ?? '';
        $content = $_POST['content'] ?? '';
        
        // Aquí usa $_POST['id'], no $_GET['id']
        $uuid = $_POST['id']; 
        
        $note->setTitle($title);
        $note->setContent($content);
        $note->update();
    }
} else {
    header('Location: http://localhost/notas/?view=home');
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
    <h1>View</h1>
    
    <form action="?view=view&id=<?php $note->getUUID();?>" method="POST">
        <input type="text" name="title" placeholder="Title..." value="<?php echo $note->getTitle();?>">
        <br>
        <input type="hidden" name="id" value="<?php echo $note->getUUID();?>">
        <textarea name="content" id="" cols="30" rows="10"><?php echo $note->getContent();?></textarea>

        <input type="submit" value="Update note"/>
    </form>

</body>
</html>