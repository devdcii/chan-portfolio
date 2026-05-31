<?php
// api/admin/get_project.php
require_once __DIR__ . '/auth.php';
requireAdmin();
$id = intval($_GET['id'] ?? 0);
if (!$id) jsonResponse(['success'=>false,'message'=>'Invalid ID'],400);
try {
    $db = getDB();
    $stmt = $db->prepare("SELECT * FROM projects WHERE id=?");
    $stmt->execute([$id]);
    $project = $stmt->fetch();
    if (!$project) jsonResponse(['success'=>false,'message'=>'Not found'],404);
    jsonResponse(['success'=>true,'project'=>$project]);
} catch(Exception $e){ jsonResponse(['success'=>false,'message'=>'Error'],500); }