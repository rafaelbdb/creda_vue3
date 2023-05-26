<?php
// session_start();

header("Content-Type: application/json");

require_once __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->load();

$request = explode('/', trim($_SERVER['REQUEST_URI'], '/'));
$endpoint = array_shift($request);

try {
    switch ($endpoint) {
        case 'api':
            $resource = array_shift($request);
            switch ($resource) {
                case 'users':
                    require_once __DIR__ . '/users.php';
                    break;
                case 'categories':
                    $_SERVER['PATH_INFO'] = '/' . implode('/', $request);
                    require_once __DIR__ . '/categories.php';
                    break;
                case 'movements':
                    $_SERVER['PATH_INFO'] = '/' . implode('/', $request);
                    require_once __DIR__ . '/movements.php';
                    break;
                case 'login':
                    $_SERVER['PATH_INFO'] = '/' . implode('/', $request);
                    require_once __DIR__ . '/login.php';
                    break;
                case 'auth':
                    $_SERVER['PATH_INFO'] = '/' . implode('/', $request);
                    require_once __DIR__ . '/auth.php';
                    break;
                default:
                    http_response_code(404);
                    echo json_encode(['error' => 'Route not found']);
                    break;
            }
            break;
        default:
            http_response_code(404);
            echo json_encode(['error' => 'Route not found']);
            break;
    }
} catch (\Throwable $th) {
    http_response_code(500);
    echo json_encode(['error' => 'Internal server error']);
    error_log($th->getMessage());
}
