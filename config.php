<?php
  # Load this file first to prepare config for others.
  
  function getIni() {
    $ini = parse_ini_file('/etc/qgov-payment-conf.ini');
    return $ini;
  }
?>
