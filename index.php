<?php
include 'sessionend.php';
 require('functions.php');
 $class=new webanalyzer();
 $ip=$class->get_ip();
 $count=$class->check_ip($ip);
 if($count>0)
   {
    $state= $class->update_info($ip);
   }
   else {
     $state=$class->insert_info($ip);
   }

 ?>
