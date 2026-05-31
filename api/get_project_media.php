<?php
// api/get_project_media.php
require_once 'config.php';

$id = intval($_GET['id'] ?? 0);
if (!$id) jsonResponse(['success' => false, 'message' => 'Invalid project ID.'], 400);

try {
    $db = getDB();

    $stmt = $db->prepare("SELECT * FROM projects WHERE id = ?");
    $stmt->execute([$id]);
    $project = $stmt->fetch();
    if (!$project) jsonResponse(['success' => false, 'message' => 'Project not found.'], 404);

    $stmt = $db->prepare("SELECT * FROM project_media WHERE project_id = ? ORDER BY sort_order ASC, created_at ASC");
    $stmt->execute([$id]);
    $media = $stmt->fetchAll();

    // Prepend upload URL
    foreach ($media as &$m) {
        if ($m['url'] && strpos($m['url'], 'http') !== 0) {
            $m['url'] = UPLOAD_URL . $m['url'];
        }
    }
    if ($project['thumbnail'] && strpos($project['thumbnail'], 'http') !== 0) {
        $project['thumbnail'] = UPLOAD_URL . $project['thumbnail'];
    }

    jsonResponse(['success' => true, 'project' => $project, 'media' => $media]);
} catch (Exception $e) {
    jsonResponse(['success' => false, 'message' => 'Could not load project.'], 500);
}
?>