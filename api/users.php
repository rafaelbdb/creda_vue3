<?php

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/connection.php';

$method = $_SERVER['REQUEST_METHOD'];
$request = explode('/', trim($_SERVER['PATH_INFO'], '/'));
$input = json_decode(file_get_contents('php://input'), true);

$table_name = 'users';
$id = $request[0] ?? null;

switch ($method) {
    case 'GET':
        $sql = "SELECT * FROM $table_name " . ($id ? "WHERE id = ?" : "");
        $stmt = $pdo->prepare($sql);
        $stmt->execute($id ? [$id] : []);
        echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
        break;
    case 'POST':
        $stmt = $pdo->prepare("INSERT INTO $table_name (name, email, password) VALUES (?, ?, ?)");
        $stmt->execute([$input['name'], $input['email'], $input['password']]);

        if ($stmt->rowCount() > 0) {
            echo json_encode(['message' => 'User created successfully']);
        } else {
            echo json_encode(['message' => 'Could not create user']);
        }
        break;
    case 'PUT':
        $stmt = $pdo->prepare("UPDATE $table_name SET name = ?, email = ?, password = ? WHERE id = ?");
        $stmt->execute([$input['name'], $input['email'], $input['password'], $id]);

        if ($stmt->rowCount() > 0) {
            echo json_encode(['message' => 'User updated successfully']);
        } else {
            echo json_encode(['message' => 'No changes were made to the user']);
        }
        break;
    case 'PATCH':
        $fields = [];
        $values = [];

        foreach ($input as $field => $value) {
            $fields[] = "$field = ?";
            $values[] = $value;
        }

        $values[] = $id;

        $sql = "UPDATE $table_name SET " . implode(', ', $fields) . " WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute($values);

        if ($stmt->rowCount() > 0) {
            echo json_encode(['message' => 'User updated successfully']);
        } else {
            echo json_encode(['message' => 'No changes were made to the user']);
        }
        break;
    case 'DELETE':
        $stmt = $pdo->prepare("DELETE FROM $table_name WHERE id = ?");
        $stmt->execute([$id]);

        if ($stmt->rowCount() > 0) {
            echo json_encode(['message' => 'User deleted successfully']);
        } else {
            echo json_encode(['message' => 'Could not delete user']);
        }
        break;
        // case 'OPTIONS':
        //     header("Access-Control-Allow-Origin: http://localhost:8080");
        //     header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
        //     header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
        //     break;

    default:
        http_response_code(405);
        echo json_encode(['error' => 'Method not allowed']);
        break;
}
