<?php

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/connection.php';

$method = $_SERVER['REQUEST_METHOD'];
$request = explode('/', trim($_SERVER['PATH_INFO'], '/'));
$input = json_decode(file_get_contents('php://input'), true);

$table_name = 'categories';



// $loggedUserId = $_SESSION['user_id'];
$loggedUserId = 1;



$id = $request[0] ?? null;

switch ($method) {
    case 'GET':
        $sql = "SELECT * FROM $table_name WHERE user_id = ?" . ($id ? " AND id = ?" : "");
        $stmt = $pdo->prepare($sql);
        $stmt->execute($id ? [$loggedUserId, $id] : [$loggedUserId]);
        echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
        break;
    case 'POST':
        $stmt = $pdo->prepare("INSERT INTO $table_name (user_id, name, type) VALUES (?, ?, ?)");
        $stmt->execute([$loggedUserId, $input['name'], $input['type']]);

        if ($stmt->rowCount() > 0) {
            echo json_encode(['message' => 'Category created successfully']);
        } else {
            echo json_encode(['message' => 'Could not create new category']);
        }
        break;
    case 'PATCH':
        $fields = [];
        $values = [];

        foreach ($input as $field => $value) {
            $fields[] = "$field = ?";
            $values[] = $value;
        }

        $values[] = $loggedUserId;
        $values[] = $id;

        $sql = "UPDATE $table_name SET " . implode(', ', $fields) . " WHERE user_id = ? AND id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute($values);

        if ($stmt->rowCount() > 0) {
            echo json_encode(['message' => 'Category updated successfully']);
        } else {
            echo json_encode(['message' => 'No changes were made to the category']);
        }
        break;
    case 'PUT':
        $stmt = $pdo->prepare("UPDATE $table_name SET user_id = ?, name = ?, type = ? WHERE id = ?");
        $stmt->execute([$loggedUserId, $input['name'], $input['type'], $id]);

        if ($stmt->rowCount() > 0) {
            echo json_encode(['message' => 'Category updated successfully']);
        } else {
            echo json_encode(['message' => 'No changes were made to the category']);
        }
        break;
    case 'DELETE':
        $stmt = $pdo->prepare("DELETE FROM $table_name WHERE user_id = ? AND id = ?");
        $stmt->execute([$loggedUserId, $id]);

        if ($stmt->rowCount() > 0) {
            echo json_encode(['message' => 'Category deleted successfully']);
        } else {
            echo json_encode(['message' => 'Could not delete category']);
        }
        break;

    default:
        http_response_code(405);
        echo json_encode(['error' => 'Method not allowed']);
        break;
}
