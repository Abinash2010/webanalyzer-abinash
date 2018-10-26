<?php
require_once('db.php');
class webanalyzer
{

  private $conn;

  	public function __construct()
  	{
  		$database = new db();
  		$db = $database->getDB();
  		$this->conn = $db;
      }
  function get_ip()
  {
    $IP = getHostByName(php_uname('n'));
    return $IP;
  }
  function  check_ip($ip)
  {
    $stmt=$this->conn->prepare('SELECT * FROM `activity` where ip_address=:ip');
    $stmt->bindParam(':ip',$ip,PDO::PARAM_STR);
    $stmt->execute();
    $data=$stmt->fetch(PDO::FETCH_OBJ);
    return $stmt->rowCount();
  }

  function update_info($ip)
  {
    $status=1;
    $first=date('y-m-d H:i:s');
    $stmt=$this->conn->prepare('UPDATE `activity` SET status=:status,start=:first,end=:end WHERE ip_address=:ip');
    $stmt->bindParam(':ip',$ip,PDO::PARAM_STR);
    $stmt->bindParam(':status',$status,PDO::PARAM_STR);
    $stmt->bindParam(':first',$first,PDO::PARAM_STR);
    $stmt->bindParam(':end',$first,PDO::PARAM_STR);
    if($stmt->execute())
    {
      header('location:first.php');
    }
    else {
      return 0;
    }

  }
  function insert_info($ip)
  {
    $status=1;
    $first=date('y-m-d H:i:s');
    $stmt=$this->conn->prepare('INSERT INTO `activity` VALUES (:ip,:dates,:status,:start,:ends)');
    $stmt->bindParam(':ip',$ip,PDO::PARAM_STR);
    $stmt->bindParam(':dates',$first,PDO::PARAM_STR);
    $stmt->bindParam(':status',$status,PDO::PARAM_STR);
    $stmt->bindParam(':start',$first,PDO::PARAM_STR);
    $stmt->bindParam(':ends',$first,PDO::PARAM_STR);
    if($stmt->execute())
    {
      return 1;
    }
    else {
      return 0;
    }
  }
  function session_init($ip)
  {
    session_start();
    $_SESSION['id']=$ip;
  }

  function session_end()
  {
    session_start();
    session_destroy();
  }
  function update_status($ip)
  {
    $status=1;
    $time=date('y-m-d H:i:s');
    $stmt=$this->conn->prepare('UPDATE `activity` SET status=:status,end=:ends where ip_address=:ip');
    $stmt->bindParam(':ip',$ip,PDO::PARAM_STR);
    $stmt->bindParam(':status',$status,PDO::PARAM_STR);
    $stmt->bindParam(':ends',$time,PDO::PARAM_STR);
    $stmt->execute();

  }
  function update_status_end($ip)
  {
    $status=0;
    $stmt=$this->conn->prepare('UPDATE `activity` SET status=:status where ip_address=:ip');
    $stmt->bindParam(':ip',$ip,PDO::PARAM_STR);
    $stmt->bindParam(':status',$status,PDO::PARAM_STR);
    $stmt->execute();

  }
  function shapeSpace_system_load($coreCount = 2, $interval = 1) {
	$rs = sys_getloadavg();
	$interval = $interval >= 1 && 3 <= $interval ? $interval : 1;
	$load = $rs[$interval];
	return round(($load * 100) / $coreCount,2);
}
}
 ?>
