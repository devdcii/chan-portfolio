<?php
// api/admin/auth.php — included by all admin API files
require_once dirname(__DIR__) . '/config.php';

session_name(ADMIN_SESSION);
session_start();

function requireAdmin(): array {
    if (empty($_SESSION['admin_id'])) {
        jsonResponse(['success' => false, 'message' => 'Unauthorized. Please log in.'], 401);
    }
    return ['id' => $_SESSION['admin_id'], 'full_name' => $_SESSION['admin_name'] ?? 'Admin'];
}
?>