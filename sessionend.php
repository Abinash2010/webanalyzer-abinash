<?php
include 'db.php';
$dbs=new db();
$db=$dbs->getDB();
$status=1;
$data=$db->prepare('SELECT * FROM `activity` where status=:status');
$data->bindParam(':status',$status);
$data->execute();
$active=$data->fetchAll(PDO::FETCH_ASSOC);
foreach($active as $row)
{
  if($row['status']==1)
  {
    $date=time();
    $date1=$row['end'];
    $date2=strtotime($date1);
  $seconds_diff = $date - $date2;
  $diff=($seconds_diff/60);

    if($diff>5){
    echo  $statuss=0;
      $data1=$db->prepare('UPDATE `activity` SET  status=:status1 where ip_address=:ips');
      $data1->bindParam(':status1',$statuss);
      $data1->bindParam(':ips',$row['ip_address']);
      $data1->execute();
    }



  }
}


 ?>
