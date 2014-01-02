<?php
  require_once 'config.php';
  require_once 'soapclient.php';
  require_once 'dao.php';
  require_once 'cart_func.php';
  
  function createRequest($cartId, $serviceId, $title, $ref, $cost, $gst, $agency, $desc, $disbursementId, 
      $costCentre, $glCode, $taxCode, $narrative, $downloadTitle, $downloadType, $downloadSize) {
    error_log("Adding to cart: $cartId");
    if ($cartId) {
      $cartId = "<cartId>$cartId</cartId>";
    }  
    
    $ini = getIni();
    $username = $ini['username'];
    $serviceName = "Test service";#TODO - come from config
    $context = $ini['context'];    
    $notifyUri = "http://$_SERVER[HTTP_HOST]$context/notify.php";
    $downloadUri = "http://$_SERVER[HTTP_HOST]$context/download.php";
    $shopUri = "http://$_SERVER[HTTP_HOST]$context/shop.php";
    
    $tokens = array("@CART_ID@", "@NOTIFY_URI@", "@SHOP_URI@", "@DOWNLOAD_URI@", "@SERVICE_ID@", "@USERNAME@", "@SERVICE_NAME@",
      "@TITLE@", "@REF@", "@COST@", "@GST@", "@AGENCY@", "@DESC@", "@DISBURMENT_ID@", "@COST_CENTRE@", "@GL_CODE@", "@TAX_CODE@", "@NARRATIVE@",
      "@DOWNLOAD_TITLE@", "@DOWNLOAD_TYPE@", "@DOWNLOAD_SIZE@"
    );
    $values = array("$cartId", "$notifyUri", "$shopUri", "$downloadUri", "$serviceId", "$username", "$serviceName",
      "$title", "$ref", "$cost", "$gst", "$agency", "$desc", "$disbursementId", "$costCentre", "$glCode", "$taxCode", "$narrative", 
      "$downloadTitle", "$downloadType", "$downloadSize"
    );
    $template ='
      <CartAddRequest>@CART_ID@
        <order>
          <onlineService id="@USERNAME@" name="@SERVICE_NAME@" notify="@NOTIFY_URI@?serviceId=@SERVICE_ID@" prev="@SHOP_URI@" next="@SHOP_URI@"/>
          <orderline id="@SERVICE_ID@">
            <product title="@TITLE@"
              ref="@REF@" cost="@COST@" gst="@GST@"
              agency="@AGENCY@"
              description="@DESC@"
              disbursementId="@DISBURMENT_ID@">
              <accounting costCenter="@COST_CENTRE@" glCode="@GL_CODE@" taxCode="@TAX_CODE@" narrative="@NARRATIVE@"/>
              <distribution title="@DOWNLOAD_TITLE@">
                <resource link="@DOWNLOAD_URI@?serviceId=@SERVICE_ID@" type="@DOWNLOAD_TYPE@" size="@DOWNLOAD_SIZE@" />
              </distribution>
            </product>
          </orderline>
        </order>
      </CartAddRequest>';
    return str_replace($tokens, $values, $template);
  }
  
  function addToCart($title, $ref, $cost, $gst, $agency, $desc, $disbursementId, 
      $costCentre, $glCode, $taxCode, $narrative, $downloadTitle, $downloadType, $downloadSize) {
    $cartId = getCartId();
    $serviceId = createServiceId();
    $body = createRequest($cartId, $serviceId, $title, $ref, $cost, $gst, $agency, $desc, $disbursementId, 
      $costCentre, $glCode, $taxCode, $narrative, $downloadTitle, $downloadType, $downloadSize);
    $namespace = 'http://smartservice.qld.gov.au/payment/schemas/shopping_cart_1_3';
    $result = send($body, $namespace);
    if (strpos($result, '<status>OK</status>') !== false) {
      $cleanedForPhp = str_replace('xmlns=', 'ns=', $result);
      $xml = new SimpleXMLElement($cleanedForPhp);
      $orderId = $xml->xpath('//generatedOrderId');
      $orderId = $orderId[0];
      
      $cartId = $xml->xpath('//cartId');
      $cartId = $cartId[0];
      setCartId($cartId);
      
      error_log("Successfully added to cart: $cartId with Order ID: $orderId");
      saveService($serviceId, $orderId);
      return true;
    }
  
    error_log("Request failed: $result");        
    return false;
  }
  
  $title = "A product";
  $ref = "Reference";
  $cost = "100";
  $gst = "10";
  $agency = "Some agency";
  $desc = "Some description";
  $disbursementId = "999";
  $costCentre = "ABC";
  $glCode = "A-2A-123";
  $taxCode = "FT";
  $narrative = "Accounting Narrative";
  $downloadTitle = "The download";
  $downloadType = "a file";
  $downloadSize = "1 kb";
  
  $added = addToCart($title, $ref, $cost, $gst, $agency, $desc, $disbursementId, 
      $costCentre, $glCode, $taxCode, $narrative, $downloadTitle, $downloadType, $downloadSize);
  if ($added) {
    header("Location: shop.php");
    return;
  }
  
  error_log("Request failed: $result");
  echo "Something went wrong";
?>
