<?php

declare(strict_types=1);

namespace Api\Helpers;
require_once __DIR__ . '/../../vendor/autoload.php';

use PDO;
use PDOException;
use Api\Helpers\Aux;

class Connection
{
    private PDO $pdo;

    public function __construct()
    {
        $aux = new Aux();
        $aux->enver();

        $dsn = "{$_ENV['DB_TYPE']}:host={$_ENV['DB_HOST']};port={$_ENV['DB_PORT']};dbname={$_ENV['DB_DATABASE']}";

        try {
            $this->pdo = new PDO($dsn, $_ENV['DB_USERNAME'], $_ENV['DB_PASSWORD']);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
            exit();
        }
    }

    public function getPdo(): PDO
    {
        // WARNING: This is a bad practice. It's just for testing.
        return $this->pdo;
    }

    // public function __destruct()
    // {
    //     if ($this->pdo !== null) {
    //         $this->pdo = null;
    //     }
    // }
}
