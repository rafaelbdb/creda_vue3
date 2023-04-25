<?php
header("Content-Type: application/json");

require_once __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->load();

switch ($_SERVER['REQUEST_URI']) {
    case '/api/users':
        require_once __DIR__ . '/users.php';
        break;
    default:
        http_response_code(404);
        echo json_encode(['error' => 'Route not found']);
        break;
}
