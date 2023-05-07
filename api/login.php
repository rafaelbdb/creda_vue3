<?php

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/connection.php';

session_start();
header('Content-Type: application/json');

$method = $_SERVER['REQUEST_METHOD'];
$request = explode('/', trim($_SERVER['PATH_INFO'], '/'));
$input = json_decode(file_get_contents('php://input'), true);

try {
    switch ($method) {
        case 'POST':
            $email = $input['email'];
            $password = $input['password'];
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

            $sql = "SELECT * FROM users WHERE email = ? AND password = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$email, $password]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($user) {
                // WARNING: This is not secure, do not use in production
                if (!password_verify($user['password'], $hashedPassword)) {
                    http_response_code(400);
                    echo json_encode(['error' => 'Wrong password']);
                }
                $_SESSION['user_id'] = $user['id'];
                http_response_code(200);
                echo json_encode(['message' => 'Welcome!']);
            } else {
                http_response_code(404);
                echo json_encode(['error' => 'User not found']);
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
