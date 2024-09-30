<?php

declare(strict_types=1);


namespace Spikey\Notas\models;

use PDO;
use  Spikey\Notas\lib\Database;

// This class represents a Note and provides methods for saving, updating, and retrieving notes from the database.
class Note extends Database
{

    private string $uuid;

    public function __construct(private string $title, private string $content)
    {
        parent::__construct();//Run database
        $this->uuid = uniqid();
    }



    public function save()
    { // Saves the current Note object to the database, updating the id,  title, content and updated tables .


        $query = $this->connect()->prepare("INSERT INTO notes (uuid, title, content, updated) VALUES (:uuid, :title, :content, NOW())");//Values (:nombre_etq, nombre_etq, etc)
        $query->execute(['title' => $this->title, 'uuid' => $this->uuid, 'content' => $this->content]);//Asignar etiquetas
    }

    public function update()
    { // Update the current note 
        $query = $this->connect()->prepare("UPDATE notes SET title = :title, content = :content, updated = NOW() WHERE uuid = :uuid ");
        $query->execute(['title' => $this->title, 'uuid' => $this->uuid, 'content' => $this->content]);
    }



    /*-----------Static functions------------*/


    public static function get(string $uuid): ?Note
    { // Search for a database element and returns it like a Note type 
        $database = new Database();
        $query = $database->connect()->prepare("SELECT * FROM notes WHERE uuid = :uuid ");
        $query->execute(['uuid' => $uuid]);

        $data = $query->fetch(PDO::FETCH_ASSOC);

        if ($data === false) {
            // Manejar el caso donde no se encontró la nota
            return null; // o lanzar una excepción, según lo que prefieras
        }

        return Note::CreateFromArray($data);
    }

    
    
    public static function CreateFromArray(array $array): Note
    {//Create a note with db data 
        $note = new Note($array['title'], $array['content']);
        $note->setUUID($array['uuid']);

        return $note;
    }

    
    public static function getAll(): array
    { //get all notes in db

       $notes = [];
        $database = new Database();
        $query = $database->connect()->prepare("SELECT * FROM notes");
        $query->execute();
        //turn the data into an aso array
        while($record = $query->fetch(PDO::FETCH_ASSOC)){
            $note = Note::CreateFromArray($record);
            array_push($notes, $note);
        }

        return $notes;
    }

    /*--------------Getters---------------*/
    public function getUUID(): string
    {
        return $this->uuid;
    }
   
    public function getTitle(): string
    {
        return $this->title;
    }

    public function getContent(): string 
    {
        return $this->content;
    }

    /*--------Setters------------*/
    public function setUUID($value)
    {
        $this->uuid = $value;
    }

    public function setTitle($value)
    {
        $this->title = $value;
    }

    public function setContent($value)
    {
        $this->content = $value;
    }
}
