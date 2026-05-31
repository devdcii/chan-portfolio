<?php
// api/admin/delete_project.php
require_once __DIR__ . '/auth.php';
requireAdmin();
if($_SERVER['REQUEST_METHOD']!=='POST') jsonResponse(['success'=>false,'message'=>'Method not allowed'],405);
$id=intval($_POST['id']??0);
if(!$id) jsonResponse(['success'=>false,'message'=>'Invalid ID'],400);
try{
    $db=getDB();
    // Delete all media files from disk first
    $stmt=$db->prepare("SELECT filename FROM project_media WHERE project_id=?");
    $stmt->execute([$id]);
    foreach($stmt->fetchAll() as $m){
        $fp=UPLOAD_DIR.$m['filename'];
        if(file_exists($fp)) @unlink($fp);
    }
    // DB cascade deletes media rows
    $db->prepare("DELETE FROM projects WHERE id=?")->execute([$id]);
    jsonResponse(['success'=>true,'message'=>'Project deleted.']);
}catch(Exception $e){jsonResponse(['success'=>false,'message'=>'Error'],500);}
?>