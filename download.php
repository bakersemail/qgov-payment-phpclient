<?php
  require_once 'pay_func.php';
    
  $serviceId = $_REQUEST['serviceId'];
  if (!paymentRequestReceived($serviceId)) {
    echo "Not paid for $serviceId";
    return 0;
  }
  
  echo "Paid for $serviceId";
  return 1;
?>
