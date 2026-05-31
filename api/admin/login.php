<?php
// api/admin/login.php
require_once dirname(__DIR__) . '/config.php';
session_name(ADMIN_SESSION);
session_start();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') jsonResponse(['success'=>false,'message'=>'Method not allowed.'],405);

$username = trim($_POST['username'] ?? '');
$password = $_POST['password'] ?? '';

if (!$username || !$password) jsonResponse(['success'=>false,'message'=>'Username and password required.'],400);

try {
    $db = getDB();
    $stmt = $db->prepare("SELECT * FROM admin_users WHERE username = ? LIMIT 1");
    $stmt->execute([$username]);
    $admin = $stmt->fetch();

    if (!$admin || !password_verify($password, $admin['password'])) {
        jsonResponse(['success'=>false,'message'=>'Invalid username or password.'],401);
    }

    $_SESSION['admin_id']   = $admin['id'];
    $_SESSION['admin_name'] = $admin['full_name'];
    $_SESSION['admin_role'] = $admin['role'];

    // Update last login
    $db->prepare("UPDATE admin_users SET last_login = NOW() WHERE id = ?")->execute([$admin['id']]);

    jsonResponse(['success'=>true,'admin'=>['id'=>$admin['id'],'full_name'=>$admin['full_name'],'role'=>$admin['role']]]);
} catch(Exception $e) {
    jsonResponse(['success'=>false,'message'=>'Server error.'],500);
}
?>