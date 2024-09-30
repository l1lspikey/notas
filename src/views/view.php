<?php 
use Spikey\Notas\models\Note;



if (isset($_GET['id'])){

    $note = Note::get($_GET['id']);

}else
{

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
    
    <form action="?view=create" method="POST">
        <input type="text" name="title" placeholder="Title..." value="<?php echo $note->getTitle()?>">
        <br>
        <textarea name="content" id="" cols="30" rows="10"><?php echo $note->getContent();?></textarea>

        <input type="submit" value="Create note"/>
    </form>

</body>
</html>