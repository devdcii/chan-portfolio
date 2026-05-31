<?php
// api/admin/get_inquiries.php
require_once __DIR__ . '/auth.php';
requireAdmin();
try{
    $db=getDB();
    $stmt=$db->query("SELECT * FROM inquiries ORDER BY created_at DESC");
    jsonResponse(['success'=>true,'inquiries'=>$stmt->fetchAll()]);
}catch(Exception $e){jsonResponse(['success'=>false,'message'=>'Error'],500);}
?>