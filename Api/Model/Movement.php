<?php

declare(strict_types=1);

namespace Api\Model;

use PDO;
use PDOException;
use Exception;
use Api\Helpers\Connection;

class Movement
{
    private Connection $conn;
    private PDO $pdo;
    private string $table;

    public function __construct(string $table)
    {
        $this->conn = new Connection();
        $this->pdo = $this->conn->getPdo();
        $this->table = $table;
    }

    public function create(array $data): ?string
    {
        $stmt = $this->pdo->prepare("INSERT INTO $this->table (created_by, updated_by, updated_at, origin, destiny, amount, description) VALUES (:created_by, :updated_by, to_timestamp(:updated_at), :origin, :destiny, :amount, :description)");
        $stmt->bindParam(':created_by', $data['userId']);
        $stmt->bindParam(':updated_by', $data['userId']);
        $stmt->bindParam(':updated_at', $data['agora']);
        $stmt->bindParam(':origin', $data['origin']);
        $stmt->bindParam(':destiny', $data['destiny']);
        $stmt->bindParam(':amount', $data['amount']);
        $stmt->bindParam(':description', $data['description']);

        try {
            $stmt->execute();
            return $this->pdo->lastInsertId();
        } catch (PDOException $e) {
            error_log($e->getMessage(), 0, '../logs/php-error.log');
            return null;
        }
    }

    public function search(array $data): ?array
    {
        $query = "SELECT * FROM $this->table WHERE ";
        if ($data['id']) {
            $query .= 'id';
            $param = $data['id'];
        } else {
            $query .= 'created_by';
            $param = $data['userId'];
        }
        $query .= ' = :id';

        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':id', $param);

        try {
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            error_log($e->getMessage(), 0, '../logs/php-error.log');
            return null;
        }
    }

    public function update(array $data): int
    {
        $stmt = $this->pdo->prepare("UPDATE $this->table SET updated_by = :updated_by, updated_at = to_timestamp(:updated_at), origin = :origin, destiny = :destiny, amount = :amount, description = :description WHERE id = :id");
        $stmt->bindParam(':updated_by', $data['userId']);
        $stmt->bindParam(':updated_at', $data['agora']);
        $stmt->bindParam(':origin', $data['origin']);
        $stmt->bindParam(':destiny', $data['destiny']);
        $stmt->bindParam(':amount', $data['amount']);
        $stmt->bindParam(':description', $data['description']);
        $stmt->bindParam(':id', $data['id']);

        try {
            $stmt->execute();
        } catch (Exception $e) {
            error_log($e->getMessage(), 0, '../logs/php-error.log');
        }
        return $stmt->rowCount();
    }

    public function delete(string $id): int
    {
        $stmt = $this->pdo->prepare("DELETE FROM $this->table WHERE id = :id");
        $stmt->bindParam(':id', $id);

        try {
            $stmt->execute();
        } catch (Exception $e) {
            error_log($e->getMessage(), 0, '../logs/php-error.log');
        }
        return $stmt->rowCount();
    }
}
