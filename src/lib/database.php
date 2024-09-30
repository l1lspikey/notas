<?php

declare(strict_types=1);

namespace Spikey\Notas\lib;

use PDO;
use PDOException;

class Database
{


    private string $host;
    private string $database;
    private string $user;
    private string $password;
    private string $charset;


    public function __construct()
    {
        $this->host = 'localhost';
        $this->database = 'notas';
        $this->user = 'root';
        $this->password = '';
        $this->charset = 'utf8mb4';
    }

    public function connect()
    {
        try {
            $connection = "mysql:host={$this->host}; dbname={$this->database}; charset={$this->charset}";
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_EMULATE_PREPARES => false
            ];
                
            $pdo = new PDO($connection, $this->user, $this->password, $options);

            return $pdo;

        } catch (PDOException $th) {
            throw $th;
        }
    }
}
