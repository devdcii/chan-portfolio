<?php
// api/admin/save_project.php
require_once __DIR__ . '/auth.php';
requireAdmin();
if ($_SERVER['REQUEST_METHOD'] !== 'POST') jsonResponse(['success'=>false,'message'=>'Method not allowed'],405);

$title       = trim($_POST['title'] ?? '');
$description = trim($_POST['description'] ?? '');
$category    = trim($_POST['category'] ?? 'Other');
$tech_stack  = trim($_POST['tech_stack'] ?? '');
$year        = trim($_POST['year'] ?? '') ?: null;
$is_featured = isset($_POST['is_featured']) ? 1 : 0;
$github_url  = trim($_POST['github_url'] ?? '');
$live_url    = trim($_POST['live_url'] ?? '');

if (!$title) jsonResponse(['success'=>false,'message'=>'Title is required.'],400);

if (!is_dir(UPLOAD_DIR)) mkdir(UPLOAD_DIR, 0755, true);

try {
    $db = getDB();
    $stmt = $db->prepare("
        INSERT INTO projects (title, description, category, tech_stack, year, is_featured, github_url, live_url)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)
    ");
    $stmt->execute([$title, $description, $category, $tech_stack, $year, $is_featured, $github_url, $live_url]);
    $projectId = $db->lastInsertId();

    if (!empty($_FILES['media']['name'][0])) {
        $thumbnailSet = false;
        foreach ($_FILES['media']['tmp_name'] as $i => $tmp) {
            if ($_FILES['media']['error'][$i] !== UPLOAD_ERR_OK) continue;
            $origName = $_FILES['media']['name'][$i];
            $ext      = strtolower(pathinfo($origName, PATHINFO_EXTENSION));
            $isVideo  = in_array($ext, ALLOWED_VIDEOS);
            $isImage  = in_array($ext, ALLOWED_IMAGES);
            if (!$isImage && !$isVideo) continue;
            if ($_FILES['media']['size'][$i] > ($isVideo ? MAX_VIDEO_SIZE : MAX_IMAGE_SIZE)) continue;

            $newName  = 'project_' . $projectId . '_' . uniqid() . '.' . $ext;
            $destPath = UPLOAD_DIR . $newName;
            if (move_uploaded_file($tmp, $destPath)) {
                $type = $isVideo ? 'video' : 'image';
                $db->prepare("INSERT INTO project_media (project_id, type, filename, url, sort_order) VALUES (?,?,?,?,?)")
                   ->execute([$projectId, $type, $newName, $newName, $i]);
                if ($isImage && !$thumbnailSet) {
                    $db->prepare("UPDATE projects SET thumbnail=? WHERE id=?")->execute([$newName, $projectId]);
                    $thumbnailSet = true;
                }
            }
        }
    }

    jsonResponse(['success'=>true,'project_id'=>$projectId,'message'=>'Project created.']);
} catch (Exception $e) {
    jsonResponse(['success'=>false,'message'=>'Database error: '.$e->getMessage()],500);
}
?>