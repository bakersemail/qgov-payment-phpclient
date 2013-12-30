<?php
  define('CART_COOKIE_NAME', 'ssqCartId');

  function setCartId($cartId) {
    setcookie(CART_COOKIE_NAME, $cartId);
  }
  
  function getCartId() {
    if (array_key_exists(CART_COOKIE_NAME, $_COOKIE)) {
      return $_COOKIE[CART_COOKIE_NAME];
    }
    
    if (array_key_exists(CART_COOKIE_NAME, $_REQUEST)) {
      $cartId = $_REQUEST[CART_COOKIE_NAME];
      setcookie(CART_COOKIE_NAME, $cartId);
      return $cartId;        
    }
    return '';    
  }

?>