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

try {
    switch ($method) {
        case 'GET':
            $sql = "SELECT * FROM $table_name WHERE user_id = ?" . ($id ? " AND id = ?" : "");
            $stmt = $pdo->prepare($sql);
            $stmt->execute($id ? [$loggedUserId, $id] : [$loggedUserId]);
            $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if ($categories) {
                http_response_code(200);
                echo json_encode($categories);
            } else {
                http_response_code(404);
                echo json_encode(['error' => 'Category(ies) not found']);
            }
            break;
        case 'POST':
            if (validateInput($input)) {
                $stmt = $pdo->prepare("INSERT INTO $table_name (user_id, name, type) VALUES (?, ?, ?)");
                $stmt->execute([$loggedUserId, $input['name'], $input['type']]);

                if ($stmt->rowCount() > 0) {
                    http_response_code(200);
                    echo json_encode(['message' => 'Category created successfully']);
                } else {
                    http_response_code(500);
                    echo json_encode(['message' => 'Could not create new category']);
                }
            } else {
                http_response_code(400);
                echo json_encode(['error' => 'Invalid input data']);
            }
            break;
        case 'PUT':
            if (validateInput($input)) {
                $stmt = $pdo->prepare("UPDATE $table_name SET user_id = ?, name = ?, type = ? WHERE id = ?");
                $stmt->execute([$loggedUserId, $input['name'], $input['type'], $id]);

                if ($stmt->rowCount() > 0) {
                    http_response_code(200);
                    echo json_encode(['message' => 'Category updated successfully']);
                } else {
                    http_response_code(500);
                    echo json_encode(['error' => 'No changes were made to the category']);
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
                echo json_encode(['message' => 'Category updated successfully']);
            } else {
                http_response_code(500);
                echo json_encode(['error' => 'No changes were made to the category']);
            }
            break;
        case 'DELETE':
            if ($id) {
                $stmt = $pdo->prepare("DELETE FROM $table_name WHERE user_id = ? AND id = ?");
                $stmt->execute([$loggedUserId, $id]);

                if ($stmt->rowCount() > 0) {
                    http_response_code(200);
                    echo json_encode(['message' => 'Category deleted successfully']);
                } else {
                    http_response_code(500);
                    echo json_encode(['error' => 'Could not delete category']);
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
    if (!isset($input['name']) || !isset($input['type'])) {
        return false;
    }

    // Validate name field
    if (empty($input['name'])) {
        return false;
    }

    return true;
}
