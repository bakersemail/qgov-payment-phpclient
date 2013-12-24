<?php
  function createDb() {
    $dbfile = 'exampledb.sqlite';
    $sql = new SQLite3($dbfile);
    if (!file_exists($dbfile)) {
      die('Could not create db');
    }
    
    $sql->exec("CREATE TABLE IF NOT EXISTS SERVICES (ID INTEGER PRIMARY KEY, SERVICE_ID INTEGER UNIQUE, ORDER_ID INTEGER, PAID INTEGER);");
    return $sql;
  }
  
  function _setPaid($serviceIds) {
    $sql = createDb();
    $idsStr = implode(", ", $serviceIds);
    $q = $sql->exec("UPDATE SERVICES SET PAID=1 WHERE SERVICE_ID IN ($idsStr);");
    return $q;
  }

  function _findByServiceId($serviceId) {
    $sql = createDb();
    $q = $sql->query("SELECT ORDER_ID FROM SERVICES WHERE SERVICE_ID=$serviceId;");
    while ($row = $q->fetchArray()) {
      $value = $row['ORDER_ID'];
      return $value;
    }
    
    return '';
  }
  
  function _saveService($serviceId, $orderId) {
    $sql = createDb();
    $q = $sql->exec("INSERT INTO SERVICES(SERVICE_ID, ORDER_ID, PAID) VALUES ($serviceId, $orderId, 0)");
    return $q;
  }
  
  function _createServiceId() {
    return rand(0, 99999999);
  } 
?>
