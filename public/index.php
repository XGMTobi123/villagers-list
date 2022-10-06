<?php

use app\controllers\SearchController;
use app\controllers\SiteController;
use app\controllers\AuthController;
use app\controllers\VillagerController;
use app\core\Application;

require_once __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

$config = [
    'db' => [
        'dsn' => $_ENV['DB_DSN'],
        'user' => $_ENV['DB_USER'],
        'password' => $_ENV['DB_PASSWORD'],
    ]
];

$app = new Application(dirname(__DIR__), $config);

$app->router->get('/', [SiteController::class, 'home']);

$app->router->get('/contact', [SiteController::class, 'contact']);
$app->router->post('/contact', [SiteController::class, 'handleContact']);

$app->router->get('/login', [AuthController::class, 'login']);
$app->router->post('/login', [AuthController::class, 'login']);

$app->router->get('/register', [AuthController::class, 'register']);
$app->router->post('/register', [AuthController::class, 'register']);

$app->router->get('/edit', [VillagerController::class, 'edit']);
$app->router->post('/edit', [VillagerController::class, 'edit']);

$app->router->get('/delete', [VillagerController::class, 'delete']);
$app->router->post('/delete', [VillagerController::class, 'delete']);

$app->router->get('/create', [VillagerController::class, 'create']);
$app->router->post('/create', [VillagerController::class, 'create']);

$app->router->post('/add', [VillagerController::class, 'add']);
$app->router->get('/add', [VillagerController::class, 'add']);

$app->router->get('/search', [SearchController::class, 'search']);
$app->router->post('/search', [SearchController::class, 'search']);

$app->router->get('/editRow', [VillagerController::class, 'editRow']);
$app->router->post('/editRow', [VillagerController::class, 'editRow']);

$app->router->get('/saveRow', [VillagerController::class, 'saveRow']);
$app->router->post('/saveRow', [VillagerController::class, 'saveRow']);

$app->run();
