<?php
  require_once 'cart_func.php';
  
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
