<?php
	require 'soapclient.php';
	require 'dao.php';
	
	function createRequest($serviceId) {
		$orderId = findByServiceId($serviceId);
		if (empty($orderId)) {
			error_log("Received notify for unknown serviceId: $serviceId");
			header("HTTP/1.0 404 Not Found");
			return 1;
		}
		
		error_log("Received notify: $serviceId with orderId: $orderId");
		$tokens = array("@ORDER_ID@");
		$values = array("$orderId");
		$template ='<OrderStatusRequest><generatedOrderId>@ORDER_ID@</generatedOrderId></OrderStatusRequest>';
		return str_replace($tokens, $values, $template);
	}
	
	$serviceId = $_REQUEST['serviceId'];
	$body = createRequest($serviceId);
	$namespace = 'http://smartservice.qld.gov.au/payment/schemas/payment_api_1_3';
	$result = send($body, $namespace);
	if (strpos($result, '<status>PAID</status>') !== false) {
		error_log("Successful notification for serviceId: $serviceId");
		echo "Done";
		return;
	}
	
	error_log("Received notify for unpaid order with serviceId: $serviceId Result: $result");
	header("HTTP/1.0 400 Bad Request");
?>