<?php
// api/admin/delete_media.php
require_once __DIR__ . '/auth.php';
requireAdmin();
if($_SERVER['REQUEST_METHOD']!=='POST') jsonResponse(['success'=>false,'message'=>'Method not allowed'],405);
$id=intval($_POST['id']??0);
if(!$id) jsonResponse(['success'=>false,'message'=>'Invalid ID'],400);
try{
    $db=getDB();
    $stmt=$db->prepare("SELECT filename,project_id FROM project_media WHERE id=?");
    $stmt->execute([$id]);
    $media=$stmt->fetch();
    if(!$media) jsonResponse(['success'=>false,'message'=>'Not found'],404);
    // Delete file from disk
    $filePath=UPLOAD_DIR.$media['filename'];
    if(file_exists($filePath)) @unlink($filePath);
    // Delete from DB
    $db->prepare("DELETE FROM project_media WHERE id=?")->execute([$id]);
    // If this was the project thumbnail, clear it
    $check=$db->prepare("SELECT thumbnail FROM projects WHERE id=?");
    $check->execute([$media['project_id']]);
    $proj=$check->fetch();
    if($proj&&$proj['thumbnail']===$media['filename']){
        // Find next image to use as thumbnail
        $next=$db->prepare("SELECT filename FROM project_media WHERE project_id=? AND type='image' ORDER BY id ASC LIMIT 1");
        $next->execute([$media['project_id']]);
        $nextThumb=$next->fetchColumn();
        $db->prepare("UPDATE projects SET thumbnail=? WHERE id=?")->execute([$nextThumb?:null,$media['project_id']]);
    }
    jsonResponse(['success'=>true,'message'=>'Deleted.']);
}catch(Exception $e){jsonResponse(['success'=>false,'message'=>'Error'],500);}
?>