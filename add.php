<?php
	require 'soapclient.php';
	
	function createRequest($cartId) {
		error_log("Adding to cart: $cartId");
		if ($cartId) {
			$cartId = "<cartId>$cartId</cartId>";
		}	
		
		$currentUri = $_SERVER["HTTP_REFERER"];
		$notifyUri = "http://$_SERVER[HTTP_HOST]/notify.php";
		$downloadUri = "http://$_SERVER[HTTP_HOST]/download.php";
		$serviceId = "123"; #TODO - match to an item
		
		$tokens = array("@CART_ID@", "@NOTIFY_URI@", "@CURRENT_URI@", "@DOWNLOAD_URI@", "@SERVICE_ID@");
		$values = array("$cartId", "$notifyUri", "$currentUri", "$downloadUri", "$serviceId");
		$template ='
			<CartAddRequest>@CART_ID@
				<order>
					<onlineService id="test" name="Test Service" notify="@NOTIFY_URI@?serviceId=@SERVICE_ID@" prev="@CURRENT_URI@" next="@CURRENT_URI@"/>
					<orderline id="orderline id">
						<product title="Test product"
							ref="reference" cost="123" gst="45"
							agency="Test agency"
							description="Test product description"
							disbursementId="999">
							<accounting costCenter="ABC" glCode="A-2A-123" taxCode="FT" narrative="Test narrative"/>
							<distribution title="Test download">
								<resource link="@DOWNLOAD_URI@?serviceId=@SERVICE_ID@" type="Test download" size="1 kb" />
							</distribution>
						</product>
					</orderline>
				</order>
			</CartAddRequest>';
		return str_replace($tokens, $values, $template);
	}
	
	$username = $_REQUEST['username'];
	$passphrase = $_REQUEST['passphrase'];
	$cartId = $_REQUEST['ssqCartId'];
	$body = createRequest($cartId);
	
	$result = send($username, $passphrase, $body);
	if (strpos($result, '<status>OK</status>') !== false) {
		error_log("Successfully added to cart: $cartId");
		header("Location: shop.php");
		return;
	}
	
	error_log("Request failed: $result");
	echo "Something went wrong";
?>