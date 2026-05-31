<?php
// api/admin/get_inquiry.php
require_once __DIR__ . '/auth.php';
requireAdmin();
$id=intval($_GET['id']??0);
if(!$id) jsonResponse(['success'=>false,'message'=>'Invalid ID'],400);
try{
    $db=getDB();
    $stmt=$db->prepare("SELECT * FROM inquiries WHERE id=?");
    $stmt->execute([$id]);
    $inq=$stmt->fetch();
    if(!$inq) jsonResponse(['success'=>false,'message'=>'Not found'],404);
    // Auto-mark as read if new
    if($inq['status']==='new'){
        $db->prepare("UPDATE inquiries SET status='read',read_at=NOW() WHERE id=?")->execute([$id]);
        $inq['status']='read';
    }
    jsonResponse(['success'=>true,'inquiry'=>$inq]);
}catch(Exception $e){jsonResponse(['success'=>false,'message'=>'Error'],500);}
?>