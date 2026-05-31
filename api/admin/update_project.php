<?php
// api/admin/update_project.php
require_once __DIR__ . '/auth.php';
requireAdmin();
if ($_SERVER['REQUEST_METHOD'] !== 'POST') jsonResponse(['success'=>false,'message'=>'Method not allowed'],405);

$id          = intval($_POST['id'] ?? 0);
$title       = trim($_POST['title'] ?? '');
$description = trim($_POST['description'] ?? '');
$category    = trim($_POST['category'] ?? 'Other');
$tech_stack  = trim($_POST['tech_stack'] ?? '');
$year        = trim($_POST['year'] ?? '') ?: null;
$is_featured = isset($_POST['is_featured']) ? 1 : 0;
$github_url  = trim($_POST['github_url'] ?? '');
$live_url    = trim($_POST['live_url'] ?? '');

if (!$id)    jsonResponse(['success'=>false,'message'=>'Invalid ID'],400);
if (!$title) jsonResponse(['success'=>false,'message'=>'Title required'],400);

try {
    $db = getDB();
    $db->prepare("
        UPDATE projects
        SET title=?, description=?, category=?, tech_stack=?, year=?,
            is_featured=?, github_url=?, live_url=?, updated_at=NOW()
        WHERE id=?
    ")->execute([$title, $description, $category, $tech_stack, $year, $is_featured, $github_url, $live_url, $id]);

    jsonResponse(['success'=>true,'message'=>'Updated.']);
} catch (Exception $e) {
    jsonResponse(['success'=>false,'message'=>'Error'],500);
}
?>