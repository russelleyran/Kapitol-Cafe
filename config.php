<?php
// ============================================
// KAPITOL CAFE - Database Configuration
// File: config.php
// ============================================

define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'kapitol_cafe');
define('SITE_URL', 'http://192.168.137.1/kapitol_cafe');
define('SITE_NAME', 'KAPITOL CAFE');

// GCash / Maya QR payment details (update with real values)
define('GCASH_NUMBER', '09XX-XXX-XXXX');
define('GCASH_NAME', 'Kapitol Cafe');
define('MAYA_NUMBER', '09XX-XXX-XXXX');

function getDB() {
    static $pdo = null;
    if ($pdo === null) {
        try {
            $pdo = new PDO(
                "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4",
                DB_USER,
                DB_PASS,
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES => false
                ]
            );
        } catch (PDOException $e) {
            die(json_encode(['error' => 'Database connection failed: ' . $e->getMessage()]));
        }
    }
    return $pdo;
}

function generateOrderCode() {
    return 'KAP-' . strtoupper(substr(md5(uniqid(rand(), true)), 0, 6));
}

session_start();
?>
