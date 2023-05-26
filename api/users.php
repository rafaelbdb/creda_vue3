<?php
// session_start();

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/connection.php';

header('Content-Type: application/json');

$method = $_SERVER['REQUEST_METHOD'];
$request = explode('/', trim($_SERVER['PATH_INFO'], '/'));
$input = json_decode(file_get_contents('php://input'), true);

$table_name = 'users';
$id = $request[0] ?? null;

try {
    switch ($method) {
        case 'GET':
            $sql = "SELECT * FROM $table_name " . ($id ? "WHERE id = ?" : "");
            $stmt = $pdo->prepare($sql);
            $stmt->execute($id ? [$id] : []);
            $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if ($users) {
                http_response_code(200);
                echo json_encode($users);
            } else {
                http_response_code(404);
                echo json_encode(['error' => 'User not found']);
            }
            break;
        case 'POST':
            if (validateInput($input)) {
                $hashedPassword = password_hash($input['password'], PASSWORD_BCRYPT);
                $stmt = $pdo->prepare("INSERT INTO $table_name (name, email, password) VALUES (?, ?, ?)");
                $stmt->execute([$input['name'], $input['email'], $hashedPassword]);

                if ($stmt->rowCount() > 0) {
                    http_response_code(201);
                    echo json_encode(['message' => 'User created successfully']);
                } else {
                    http_response_code(500);
                    echo json_encode(['error' => 'Could not create user']);
                }
            } else {
                http_response_code(400);
                echo json_encode(['error' => 'Invalid input data']);
            }
            break;
        case 'PUT':
            if (validateInput($input)) {
                $hashedPassword = password_hash($input['password'], PASSWORD_BCRYPT);
                $stmt = $pdo->prepare("UPDATE $table_name SET name = ?, email = ?, password = ? WHERE id = ?");
                $stmt->execute([$input['name'], $input['email'], $hashedPassword, $id]);

                if ($stmt->rowCount() > 0) {
                    http_response_code(200);
                    echo json_encode(['message' => 'User updated successfully']);
                } else {
                    http_response_code(500);
                    echo json_encode(['error' => 'No changes were made to the user']);
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

            $values[] = $id;
            $values['password'] = password_hash($values['password'], PASSWORD_BCRYPT);

            $sql = "UPDATE $table_name SET " . implode(', ', $fields) . " WHERE id = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute($values);

            if ($stmt->rowCount() > 0) {
                http_response_code(200);
                echo json_encode(['message' => 'User updated successfully']);
            } else {
                http_response_code(500);
                echo json_encode(['error' => 'No changes were made to the user']);
            }
            break;
        case 'DELETE':
            if ($id) {
                $stmt = $pdo->prepare("DELETE FROM $table_name WHERE id = ?");
                $stmt->execute([$id]);

                if ($stmt->rowCount() > 0) {
                    http_response_code(200);
                    echo json_encode(['message' => 'User deleted successfully']);
                } else {
                    http_response_code(500);
                    echo json_encode(['error' => 'Could not delete user']);
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
    if (!isset($input['name']) || !isset($input['email']) || !isset($input['password'])) {
        return false;
    }

    // Validate name field
    if (empty($input['name'])) {
        return false;
    }

    // Validate email field
    if (!filter_var($input['email'], FILTER_VALIDATE_EMAIL)) {
        return false;
    }

    // Validate password field
    if (strlen($input['password']) < 8) {
        return false;
    }

    return true;
}
