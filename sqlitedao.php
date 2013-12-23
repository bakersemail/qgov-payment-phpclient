<?php
  function createDb() {
    $dbfile = 'exampledb.sqlite';
    $sql = new SQLite3($dbfile);
    if (!file_exists($dbfile)) {
      die('Could not create db');
    }
    
	$sql->query("CREATE TABLE SERVICES (ID INTEGER PRIMARY KEY, SERVICE_ID INTEGER, ORDER_ID INTEGER);");
    return $sql;
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
    $q = $sql->exec("INSERT INTO SERVICES(SERVICE_ID, ORDER_ID) VALUES ($serviceId, $orderId)");
    return $q;
  }
  
  function _createServiceId() {
    return rand(0, 99999999);
  } 
?>