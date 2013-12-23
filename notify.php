<?php
  require_once 'config.php';
  require_once 'soapclient.php';
  require_once 'dao.php';
  
  function payServices($orderId, $namespace) {
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
  
  $serviceId = $_REQUEST['serviceId'];
  $orderId = findByServiceId($serviceId);
  if (empty($orderId)) {
    error_log("Received notify for unknown serviceId: $serviceId");
    header("HTTP/1.0 404 Not Found");
    return 1;
  }

  error_log("Received notify for serviceId: $serviceId orderId: $orderId");
  $body = createOrderStatusRequest($orderId);
  $namespace = 'http://smartservice.qld.gov.au/payment/schemas/payment_api_1_3';
  $result = send($body, $namespace);
  if (strpos($result, '<status>PAID</status>') !== false) {
    payServices($orderId, $namespace);
    error_log("Successful notification for serviceId: $serviceId");
    echo "Done";
    return;
  }
  
  error_log("Received notify for unpaid order with serviceId: $serviceId Result: $result");
  header("HTTP/1.0 400 Bad Request");
?>
