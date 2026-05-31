<?php
// api/get_projects.php
require_once 'config.php';

try {
    $db = getDB();
    $stmt = $db->query("
        SELECT 
            p.*,
            (SELECT COUNT(*) FROM project_media pm WHERE pm.project_id = p.id AND pm.type='image') AS image_count,
            (SELECT COUNT(*) FROM project_media pm WHERE pm.project_id = p.id AND pm.type='video') AS video_count
        FROM projects p
        ORDER BY p.is_featured DESC, p.sort_order ASC, p.created_at DESC
    ");
    $projects = $stmt->fetchAll();

    // Prepend upload URL to thumbnail paths
    foreach ($projects as &$p) {
        if ($p['thumbnail'] && strpos($p['thumbnail'], 'http') !== 0) {
            $p['thumbnail'] = UPLOAD_URL . $p['thumbnail'];
        }
    }

    jsonResponse(['success' => true, 'projects' => $projects]);
} catch (Exception $e) {
    jsonResponse(['success' => false, 'message' => 'Could not load projects.', 'projects' => []], 500);
}
?>