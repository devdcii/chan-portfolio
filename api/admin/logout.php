<?php
// api/admin/logout.php
require_once __DIR__ . '/auth.php';
$_SESSION = [];
session_destroy();
jsonResponse(['success'=>true]);
?>