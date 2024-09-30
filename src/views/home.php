<?php 
use Spikey\Notas\models\Note;


$notes = Note::getAll(); 
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
  <h1>HOME</h1>  

  <?php 
    foreach ($notes as $note) {
      
  ?>
      <a href="?view=view&id=<?php echo $note->getUUID();?>">
        <div class = "note-preview">
          <div class = "title"> <?php echo $note->getTitle(); ?> </div>

        </div>
      </a>
  <?php 
    
  
  }  
  ?>
</body>
</html>