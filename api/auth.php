<?php
// session_start();

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/connection.php';

header('Content-Type: application/json');

$method = $_SERVER['REQUEST_METHOD'];
$request = explode('/', trim($_SERVER['PATH_INFO'], '/'));
$input = json_decode(file_get_contents('php://input'), true);

try {
    switch ($method) {
        case 'GET':
            if (!isset($_SESSION['user_id'])) {
              http_response_code(401);
              echo json_encode(['auth' => false]);
              exit;
            }

            echo json_encode(['auth' => true]);
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
