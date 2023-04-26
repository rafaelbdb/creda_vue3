<?php

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/connection.php';

$method = $_SERVER['REQUEST_METHOD'];
$request = explode('/', trim($_SERVER['PATH_INFO'], '/'));
$input = json_decode(file_get_contents('php://input'), true);

$table_name = 'categories';

switch ($method) {
    case 'GET':
        $id = $_GET['id'] ?? null;
        $sql = "SELECT * FROM $table_name " . ($id ? "WHERE id = ?" : "");
        $stmt = $pdo->prepare($sql);
        $stmt->execute($id ? [$id] : []);
        echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
        break;
    case 'POST':
        $stmt = $pdo->prepare("INSERT INTO $table_name (name, type) VALUES (?, ?)");
        $stmt->execute([$input['name'], $input['type']]);
        echo json_encode(['message' => 'Category created successfully']);
        break;
    case 'PUT':
        $id = $request[0];
        $stmt = $pdo->prepare("UPDATE $table_name SET name = ?, type = ? WHERE id = ?");
        $stmt->execute([$input['name'], $input['type'], $id]);
        echo json_encode(['message' => 'Category updated successfully']);
        break;
    case 'DELETE':
        $id = $request[0];
        $stmt = $pdo->prepare("DELETE FROM $table_name WHERE id = ?");
        $stmt->execute([$id]);
        echo json_encode(['message' => 'Category deleted successfully']);
        break;

    default:
        http_response_code(405);
        echo json_encode(['error' => 'Method not allowed']);
        break;
}
