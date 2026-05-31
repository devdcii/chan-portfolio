<?php
// api/admin/upload_media.php
require_once __DIR__ . '/auth.php';
requireAdmin();
if($_SERVER['REQUEST_METHOD']!=='POST') jsonResponse(['success'=>false,'message'=>'Method not allowed'],405);
$projectId = intval($_POST['project_id']??0);
if(!$projectId) jsonResponse(['success'=>false,'message'=>'Invalid project ID'],400);
if(!is_dir(UPLOAD_DIR)) mkdir(UPLOAD_DIR,0755,true);
if(empty($_FILES['media']['name'][0])) jsonResponse(['success'=>false,'message'=>'No files received'],400);
try{
    $db=getDB();
    $uploaded=0;
    foreach($_FILES['media']['tmp_name'] as $i=>$tmp){
        if($_FILES['media']['error'][$i]!==UPLOAD_ERR_OK) continue;
        $ext=strtolower(pathinfo($_FILES['media']['name'][$i],PATHINFO_EXTENSION));
        $isVideo=in_array($ext,ALLOWED_VIDEOS); $isImage=in_array($ext,ALLOWED_IMAGES);
        if(!$isImage&&!$isVideo) continue;
        $maxSize=$isVideo?MAX_VIDEO_SIZE:MAX_IMAGE_SIZE;
        if($_FILES['media']['size'][$i]>$maxSize) continue;
        $newName='project_'.$projectId.'_'.uniqid().'.'.$ext;
        if(move_uploaded_file($tmp,UPLOAD_DIR.$newName)){
            $type=$isVideo?'video':'image';
            $db->prepare("INSERT INTO project_media (project_id,type,filename,url) VALUES (?,?,?,?)")
               ->execute([$projectId,$type,$newName,$newName]);
            // If no thumbnail set, use first image
            if($isImage){
                $hasThumbnail=$db->prepare("SELECT thumbnail FROM projects WHERE id=? AND thumbnail IS NOT NULL");
                $hasThumbnail->execute([$projectId]);
                if(!$hasThumbnail->fetchColumn()){
                    $db->prepare("UPDATE projects SET thumbnail=? WHERE id=?")->execute([$newName,$projectId]);
                }
            }
            $uploaded++;
        }
    }
    jsonResponse(['success'=>true,'uploaded'=>$uploaded,'message'=>"$uploaded file(s) uploaded."]);
}catch(Exception $e){jsonResponse(['success'=>false,'message'=>'Upload error'],500);}
?>