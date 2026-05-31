<?php
// api/admin/update_inquiry.php
require_once __DIR__ . '/auth.php';
requireAdmin();
if($_SERVER['REQUEST_METHOD']!=='POST') jsonResponse(['success'=>false,'message'=>'Method not allowed'],405);
$id=intval($_POST['id']??0);
$status=trim($_POST['status']??'');
$notes=trim($_POST['admin_notes']??'');
$allowed=['new','read','replied','archived'];
if(!$id||!in_array($status,$allowed)) jsonResponse(['success'=>false,'message'=>'Invalid data'],400);
try{
    $db=getDB();
    $repliedAt=$status==='replied'?',replied_at=NOW()':'';
    $db->prepare("UPDATE inquiries SET status=?,admin_notes=?{$repliedAt} WHERE id=?")
       ->execute([$status,$notes,$id]);
    jsonResponse(['success'=>true,'message'=>'Updated.']);
}catch(Exception $e){jsonResponse(['success'=>false,'message'=>'Error'],500);}
?>