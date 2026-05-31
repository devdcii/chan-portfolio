<?php
// api/admin/get_projects.php
require_once __DIR__ . '/auth.php';
requireAdmin();
try {
    $db = getDB();
    $stmt = $db->query("
        SELECT p.*,
            (SELECT COUNT(*) FROM project_media m WHERE m.project_id=p.id AND m.type='image') AS image_count,
            (SELECT COUNT(*) FROM project_media m WHERE m.project_id=p.id AND m.type='video') AS video_count
        FROM projects p ORDER BY p.sort_order ASC, p.created_at DESC");
    jsonResponse(['success'=>true,'projects'=>$stmt->fetchAll()]);
} catch(Exception $e){ jsonResponse(['success'=>false,'message'=>'Error.'],500); }