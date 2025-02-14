<?php
require __DIR__ . '/../vendor/autoload.php'; // Load Composer packages

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../'); // Load .env file
$dotenv->load();

// Fetch DB credentials from .env
$host = $_ENV["DB_HOST"];
$dbname = $_ENV["DB_NAME"];
$user = $_ENV["DB_USER"];
$pass = $_ENV["DB_PASS"];
$port = $_ENV["DB_PORT"];

try {
    $pdo = new PDO("pgsql:host=$host;port=$port;dbname=$dbname", $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
} catch (PDOException $e) {
    die(json_encode(["status" => "error", "message" => "Database connection failed: " . $e->getMessage()]));
}
?>