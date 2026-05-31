<?php
// api/admin/dashboard_stats.php
require_once __DIR__ . '/auth.php';
requireAdmin();

try {
    $db = getDB();
    $stats = [];
    $stats['total_projects']  = $db->query("SELECT COUNT(*) FROM projects")->fetchColumn();
    $stats['total_media']     = $db->query("SELECT COUNT(*) FROM project_media")->fetchColumn();
    $stats['total_inquiries'] = $db->query("SELECT COUNT(*) FROM inquiries")->fetchColumn();
    $stats['new_inquiries']   = $db->query("SELECT COUNT(*) FROM inquiries WHERE status='new'")->fetchColumn();

    $stmt = $db->query("SELECT id,full_name,email,subject,status,created_at FROM inquiries ORDER BY created_at DESC LIMIT 5");
    $stats['recent_inquiries'] = $stmt->fetchAll();

    jsonResponse(array_merge(['success'=>true], $stats));
} catch(Exception $e) {
    jsonResponse(['success'=>false,'message'=>'Error.'],500);
}
?>