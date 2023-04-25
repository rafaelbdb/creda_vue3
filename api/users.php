<?php

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/connection.php';

$method = $_SERVER['REQUEST_METHOD'];
$request = explode('/', trim($_SERVER['PATH_INFO'], '/'));
$input = json_decode(file_get_contents('php://input'), true);

$table_name = 'users';

switch ($method) {
    case 'GET':
        $id = $_GET['id'] ?? null;
        $sql = "SELECT * FROM $table_name " . ($id ? "WHERE id = ?" : "");
        $stmt = $pdo->prepare($sql);
        $stmt->execute($id ? [$id] : []);
        echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
        break;
    case 'POST':
        $stmt = $pdo->prepare("INSERT INTO $table_name (name, email, password) VALUES (?, ?, ?)");
        $stmt->execute([$input['name'], $input['email'], $input['password']]);
        echo json_encode(['message' => 'User created successfully']);
        break;
    case 'PUT':
        $id = $request[0];
        $stmt = $pdo->prepare("UPDATE $table_name SET name = ?, email = ?, password = ? WHERE id = ?");
        $stmt->execute([$input['name'], $input['email'], $input['password'], $id]);
        echo json_encode(['message' => 'User updated successfully']);
        break;
    case 'DELETE':
        $id = $request[0];
        $stmt = $pdo->prepare("DELETE FROM $table_name WHERE id = ?");
        $stmt->execute([$id]);
        echo json_encode(['message' => 'User deleted successfully']);
        break;

    default:
        http_response_code(405);
        echo json_encode(['error' => 'Method not allowed']);
        break;
}
