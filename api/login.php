<?php
session_start();

header('Content-Type: application/json');

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/connection.php'; //PHP_SESSION_ACTIVE

$method = $_SERVER['REQUEST_METHOD'];
$request = explode('/', trim($_SERVER['PATH_INFO'], '/'));
$input = json_decode(file_get_contents('php://input'), true);

// unset($_SESSION['user_id']);
try {
    switch ($method) {
        case 'POST':
            $email = $input['email'];
            $password = $input['password'];
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

            $sql = "SELECT * FROM users WHERE email = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$email]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($user) {
                if (!password_verify($password, $user['password'])) {
                    http_response_code(400);
                    echo json_encode(['error' => 'Wrong password']);
                    exit;
                }
                $_SESSION['user_id'] = $user['id'];
                http_response_code(200);
                echo json_encode(['message' => 'Welcome ' . $user['name'] . '!']);
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
