<?php
  require_once 'pay_func.php';
  
  $serviceId = $_REQUEST['serviceId'];
  paymentRequestReceived($serviceId);
?>
