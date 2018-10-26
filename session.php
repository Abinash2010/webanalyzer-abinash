<?php
require('functions.php');
$class=new webanalyzer();
$ip=$class->get_ip();
$class->session_init($ip);
$class->update_status($ip);
return 1;
 ?>
