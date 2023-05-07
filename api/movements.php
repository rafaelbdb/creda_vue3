<?php

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/connection.php';

session_start();
header('Content-Type: application/json');

$method = $_SERVER['REQUEST_METHOD'];
$request = explode('/', trim($_SERVER['PATH_INFO'], '/'));
$input = json_decode(file_get_contents('php://input'), true);
$loggedUserId = $_SESSION['user_id'];

$table_name = 'movements';
$id = $request[0] ?? null;

try {
    switch ($method) {
        case 'GET':
            $sql = "SELECT * FROM $table_name WHERE user_id = ?" . ($id ? " AND id = ?" : "");
            $stmt = $pdo->prepare($sql);
            $stmt->execute($id ? [$loggedUserId, $id] : [$loggedUserId]);
            $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if ($users) {
                http_response_code(200);
                echo json_encode($users);
            } else {
                http_response_code(404);
                echo json_encode(['error' => 'Movement not found']);
            }
            break;
        case 'POST':
            if (validateInput($input)) {
                $stmt = $pdo->prepare("INSERT INTO $table_name (user_id, date, category_id, description, amount) VALUES (?, ?, ?, ?, ?)");
                $stmt->execute([$loggedUserId, $input['date'], $input['category_id'], $input['description'], $input['amount']]);

                if ($stmt->rowCount() > 0) {
                    http_response_code(201);
                    echo json_encode(['message' => 'Movement created successfully']);
                } else {
                    http_response_code(500);
                    echo json_encode(['error' => 'Could not create movement']);
                }
            } else {
                http_response_code(400);
                echo json_encode(['error' => 'Invalid input data']);
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
                http_response_code(200);
                echo json_encode(['message' => 'Movement updated successfully']);
            } else {
                http_response_code(500);
                echo json_encode(['error' => 'No changes were made to the movement']);
            }
            break;
        case 'PUT':
            if (validateInput($input)) {
                $stmt = $pdo->prepare("UPDATE $table_name SET user_id = ?, date = ?, category_id = ?, description = ?, amount = ? WHERE id = ?");
                $stmt->execute([$loggedUserId, $input['date'], $input['category_id'], $input['description'], $input['amount'], $id]);

                if ($stmt->rowCount() > 0) {
                    http_response_code(200);
                    echo json_encode(['message' => 'Movement updated successfully']);
                } else {
                    http_response_code(500);
                    echo json_encode(['error' => 'No changes were made to the movement']);
                }
            } else {
                http_response_code(400);
                echo json_encode(['error' => 'Invalid input data']);
            }
            break;
        case 'DELETE':
            if ($id) {
                $stmt = $pdo->prepare("DELETE FROM $table_name WHERE user_id = ? AND id = ?");
                $stmt->execute([$loggedUserId, $id]);

                if ($stmt->rowCount() > 0) {
                    http_response_code(200);
                    echo json_encode(['message' => 'Movement deleted successfully']);
                } else {
                    http_response_code(500);
                    echo json_encode(['error' => 'Could not delete movement']);
                }
            } else {
                http_response_code(400);
                echo json_encode(['error' => 'Invalid ID']);
            }
            break;

        default:
            http_response_code(405);
            echo json_encode(['error' => 'Method not allowed']);
            break;
    }
} catch (\Throwable $th) {
    http_response_code(500);
    echo json_encode(['error' => 'Internal server error']);
    error_log($th->getMessage());
}

function validateInput($input)
{
    // Check if required fields are present
    if (!isset($input['date']) || !isset($input['category_id']) || !isset($input['description']) || !isset($input['amount'])) {
        return false;
    }
    return true;
}
