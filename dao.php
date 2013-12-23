<?php
  require_once 'sqlitedao.php';
  
  function findByServiceId($serviceId) {
    return _findByServiceId($serviceId);
  }
  
  function saveService($serviceId, $orderId) {
    return _saveService($serviceId, $orderId);
  }
  
  function createServiceId() {
    return _createServiceId();
  }
?>
