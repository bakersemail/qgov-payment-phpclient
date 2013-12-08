<?php	
	$cartId = $_REQUEST['ssqCartId'];
	$username = $_REQUEST['username'];
	$passphrase = $_REQUEST['passphrase'];
	
	if ($cartId) {
		$cartId = "<cartId>$cartId</cartId>";
	}	
	
	$notifyUri = "http://$_SERVER[HTTP_HOST]/notify.php";
	$currentUri = "http://$_SERVER[HTTP_HOST]/shop.php";
	$downloadUri = "http://$_SERVER[HTTP_HOST]/download.php";
	$namespace = "http://smartservice.qld.gov.au/payment/schemas/shopping_cart_1_3";
	$serviceId = "123"; #TODO - match to an item
	$nonce = "".rand(0, 99999999);
	$nonceBase64 = base64_encode($nonce);
	
	date_default_timezone_set('GMT');
	$created = date("Y-m-d")."T".date("H:i:s.000")."Z";
	$password = base64_encode(sha1($nonce.$created.$passphrase, true));
	
	$request = file_get_contents("request.xml");
	
	$tokens = array("@CART_ID@", "@NOTIFY_URI@", "@CURRENT_URI@", "@DOWNLOAD_URI@", "@SERVICE_ID@", "@NAMESPACE@", "@CREATED@", "@USERNAME@", "@PASSWORD@", "@NONCE@");
	$values = array("$cartId", "$notifyUri", "$currentUri", "$downloadUri", "$serviceId", "$namespace", "$created", "$username", "$password", "$nonceBase64");
	
	$request = str_replace($tokens, $values, $request);
	
	echo $request;
	
	$ch = curl_init('https://test.smartservice.qld.gov.au/payment/service/');
	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: text/xml'));
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $request);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	$output = curl_exec($ch);
	curl_close($ch);

	if (strpos($output, '<status>OK</status>') !== false) {
		header("Location: shop.php");
		return;
	} else {
		echo "Something went wrong";
	}
?>