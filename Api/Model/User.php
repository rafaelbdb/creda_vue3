<?php

declare(strict_types=1);

namespace Api\Model;

use PDO;
use PDOException;
use Api\Helpers\Connection;

class User
{
    private const TABLE = 'users';
    private Connection $conn;
    private PDO $pdo;

    public function __construct()
    {
        $this->conn = new Connection();
        $this->pdo = $this->conn->getPdo();
    }

    public function create(array $data): ?string
    {
        $hashPassword = password_hash($data['password'], PASSWORD_DEFAULT);
        $query = 'INSERT INTO ' . self::TABLE . ' (name, surname, username, email, login, password, updated_by, updated_at) VALUES (:name, :surname, :username, :email, :login, :password, :updated_by, :updated_at)';
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':name', $data['name']);
        $stmt->bindParam(':surname', $data['surname']);
        $stmt->bindParam(':username', $data['username']);
        $stmt->bindParam(':email', $data['email']);
        $stmt->bindParam(':login', $data['login']);
        $stmt->bindParam(':password', $hashPassword);
        $stmt->bindParam(':updated_by', $data['updated_by']);
        $stmt->bindParam(':updated_at', $data['updated_at']);

        try {
            $stmt->execute();
            return $this->pdo->lastInsertId();
        } catch (PDOException $e) {
            error_log($e->getMessage(), 0, '../logs/php-error.log');
            return null;
        }
    }

    public function search(?string $id = null): ?array
    {
        $query = 'SELECT * FROM ' . self::TABLE;
        $stmt = ($id) ? $this->pdo->prepare($query . ' WHERE id = :id') : $this->pdo->prepare($query);
        if ($id) {
            $stmt->bindParam(':id', $id);
        }

        try {
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log($e->getMessage(), 0, '../logs/php-error.log');
            return null;
        }
    }

    public function searchByUsername(string $username): ?array
    {
        $query = 'SELECT * FROM ' . self::TABLE . ' WHERE username = :username';
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':username', $username);

        try {
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log($e->getMessage(), 0, '../logs/php-error.log');
            return null;
        }
    }

    public function update(array $data): int
    {
        $hashPassword = password_hash($data['password'], PASSWORD_DEFAULT);

        $query = 'UPDATE ' . self::TABLE . ' SET name = :name, surname = :surname, username = :username, email = :email, password = :password, updated_by = :updated_by , updated_at = :updated_at WHERE id = :id';
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':name', $data['name']);
        $stmt->bindParam(':surname', $data['surname']);
        $stmt->bindParam(':username', $data['username']);
        $stmt->bindParam(':email', $data['email']);
        $stmt->bindParam(':password', $hashPassword);
        $stmt->bindParam(':updated_by', $data['updated_by']);
        $stmt->bindParam(':updated_at', $data['updated_at']);
        $stmt->bindParam(':id', $data['id']);

        try {
            $stmt->execute();
        } catch (PDOException $e) {
            error_log($e->getMessage(), 0, '../logs/php-error.log');
        }
        return $stmt->rowCount();
    }

    public function delete(string $id): int
    {
        $query = 'DELETE FROM ' . self::TABLE . ' WHERE id = :id';
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':id', $id);

        try {
            $stmt->execute();
        } catch (PDOException $e) {
            error_log($e->getMessage(), 0, '../logs/php-error.log');
        }
        return $stmt->rowCount();
    }
}
