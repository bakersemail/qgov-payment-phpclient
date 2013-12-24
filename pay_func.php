<?php
  require_once 'config.php';
  require_once 'soapclient.php';
  require_once 'dao.php';

  function paymentRequestReceived($serviceId) {
    if (isPaid($serviceId)) {
      error_log("Service already paid: $serviceId");
      return true;
    }
  
    $orderId = findByServiceId($serviceId);
    if (empty($orderId)) {
      error_log("Received notify for unknown serviceId: $serviceId");
      header("HTTP/1.0 404 Not Found");
      return false;
    }

    error_log("Received payment for serviceId: $serviceId orderId: $orderId");
    $body = createOrderStatusRequest($orderId);
    $namespace = 'http://smartservice.qld.gov.au/payment/schemas/payment_api_1_3';
    $result = send($body, $namespace);
    if (strpos($result, '<status>PAID</status>') === false) {
      error_log("Received notify for unpaid order with serviceId: $serviceId Result: $result");
      header("HTTP/1.0 400 Bad Request");
      return false;
    }

    $isWithinPaid = payServices($orderId, $serviceId, $namespace);
    if ($isWithinPaid) {
      error_log("Successful payment for serviceId: $serviceId");
      return true;
    }
    
    error_log("OrderId: $orderId paid for but this serviceId: $serviceId is not within it");
    return false;
  }
  
  function payServices($orderId, $serviceId, $namespace) {
    $body = createOrderQueryRequest($orderId);
    $result = send($body, $namespace);

    $cleanedForPhp = str_replace('xmlns=', 'ns=', $result);
    $xml = new SimpleXMLElement($cleanedForPhp);
    $orderlines = $xml->xpath('//orderline');
    $serviceIds = array();
    foreach ($orderlines as $orderline) {
      $attrs = $orderline->attributes();
      $serviceIds[] = $attrs['id'];
    }
    
    setPaid($serviceIds);
    return in_array($serviceId, $serviceIds);
  }
  
  function createOrderStatusRequest($orderId) {
    $tokens = array("@ORDER_ID@");
    $values = array("$orderId");
    $template ='<OrderStatusRequest><generatedOrderId>@ORDER_ID@</generatedOrderId></OrderStatusRequest>';
    return str_replace($tokens, $values, $template);
  }
  
  function createOrderQueryRequest($orderId) {
    $tokens = array("@ORDER_ID@");
    $values = array("$orderId");
    $template ='<OrderQueryRequest><generatedOrderId>@ORDER_ID@</generatedOrderId></OrderQueryRequest>';
    return str_replace($tokens, $values, $template);
  }  
?>
