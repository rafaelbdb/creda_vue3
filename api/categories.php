<?php

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/connection.php';

$method = $_SERVER['REQUEST_METHOD'];
$request = explode('/', trim($_SERVER['PATH_INFO'], '/'));
$input = json_decode(file_get_contents('php://input'), true);

$table_name = 'categories';



// $loggedUserId = $_SESSION['user_id'];
$loggedUserId = 1;




switch ($method) {
    case 'GET':
        $id = $request[0] ?? null;
        $sql = "SELECT * FROM $table_name WHERE user_id = ?" . ($id ? " AND id = ?" : "");
        $stmt = $pdo->prepare($sql);
        $stmt->execute($id ? [$loggedUserId, $id] : [$loggedUserId]);
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
