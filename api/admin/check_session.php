<?php
// api/admin/check_session.php
require_once __DIR__ . '/auth.php';
session_name(ADMIN_SESSION); session_start();
if (!empty($_SESSION['admin_id'])) {
    jsonResponse(['logged_in'=>true,'admin'=>['id'=>$_SESSION['admin_id'],'full_name'=>$_SESSION['admin_name'],'role'=>$_SESSION['admin_role']]]);
} else { jsonResponse(['logged_in'=>false]); }
?>