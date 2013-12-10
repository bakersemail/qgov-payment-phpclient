<?php
	function getCartId() {
		#TODO - get and set cartId from result in cookies so that javascript is not required.
		#TODO - make use of synchronise to ensure that user sessions are sync'd with the target cart.
	}
?>

<html>
<head>
<link type="text/css"
	href="https://test.smartservice.qld.gov.au/payment/ui/minicart_1.0.css"
	rel="stylesheet" />
<script
	src="https://test.smartservice.qld.gov.au/payment/minicart/contents_1.0.js"
	type="text/javascript"></script>

</head>



<body>
	<form action="add.php" method="POST">
		<label for="username">Username</label>
		<input id="username" type="text" name="username" value="test" />
		<label for="passphrase">Passphrase</label>
		<input id="passphrase" type="text" name="passphrase" value="test" />
		<input type="submit" value="Add" />
		<br/>
		Cart ID:
		<script type="text/javascript"><!--     
			document.write('<input type="text" name="ssqCartId" value="' + SSQ.cart.id + '" />'); 
		// --></script> 
		
	</form>

	<div style="width: 300px">
	<div id="minicart" class="aside">
		<div class="inner">
			<div id="ssq-minicart" class="placeholder">
				<h2>Cart</h2>
				<div id="ssq-minicart-view">
					<script type="text/javascript"> <!--
						document.write('<div class="ssq-minicart-loading"><p>Loading <a href=">');
						https://test.smartservice.qld.gov.au/payment/cart/view">cart</a>...</p></div             
						// --> </script>
						
					<noscript>
						<p class="ssq-minicart-noscript">Edit cart or checkout to place your order.</p>
						<div class="ssq-minicart-submit">
							<input type="hidden" id="ssq-cart-contents" name="ssq-cart-contents" value="" /> 
								<img src="https://test.smartservice.qld.gov.au/payment/minicart/synchronise?cartId=<?php cartId();?>" id="ssq-synch-img" height="0" width="0" alt="" />
								<a href="https://test.smartservice.qld.gov.au/payment/cart/checkout" id="ssq-cart-checkout"><img id="ssq_minicart_checkout" src="https://test.smartservice.qld.gov.au/payment/minicart/btn-checkout.png" alt="Checkout" /></a>
								<a href="https://test.smartservice.qld.gov.au/payment/cart/view" id="ssq-cart-edit"><img id="ssq_minicart_cart" src="https://test.smartservice.qld.gov.au/payment/minicart/btn-cart.png" alt="Edit cart" /></a>
						</div>
					</noscript>
				</div>
				<div class="ssq-minicart-cards">
					<h3>Cards accepted</h3>
					<ul>
						<li><img src="https://test.smartservice.qld.gov.au/payment/minicart/visa.png" alt="Visa" /></li>
						<li><img src="https://test.smartservice.qld.gov.au/payment/minicart/mastercard.png" alt="MasterCard" /></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	</div>

	<script
		src="https://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"
		type="text/javascript"></script>
	<script
		src="https://test.smartservice.qld.gov.au/payment/ui/minicart_1.0.js"
		type="text/javascript"></script>
</body>
</html>