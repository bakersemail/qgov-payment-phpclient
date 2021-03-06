<?php
  require_once 'config.php';

  function createEnvelope($username, $passphrase, $namespace) {
    $template = '<?xml version="1.0" encoding="utf-8"?>
      <soapenv:Envelope xmlns="@NAMESPACE@" xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/">
        <soapenv:Header>
          <wsse:Security soapenv:mustUnderstand="1" xmlns:wsse="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd">
            <wsse:UsernameToken xmlns:wsu="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-utility-1.0.xsd">
              <wsse:Username>@USERNAME@</wsse:Username>
              <wsse:Password Type="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-username-token-profile-1.0#PasswordDigest">@PASSWORD@</wsse:Password>
              <wsse:Nonce EncodingType="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-soap-message-security-1.0#Base64Binary">@NONCE@</wsse:Nonce>
              <wsu:Created>@CREATED@</wsu:Created>
            </wsse:UsernameToken>
          </wsse:Security>
        </soapenv:Header>
        <soapenv:Body>@BODY@</soapenv:Body>
      </soapenv:Envelope>';
    $nonce = rand(0, 99999999);
    $nonceBase64 = base64_encode($nonce);
    
    date_default_timezone_set('GMT');
    $created = date("Y-m-d")."T".date("H:i:s.000")."Z";
    $password = base64_encode(sha1($nonce.$created.$passphrase, true));
    $tokens = array("@NAMESPACE@", "@CREATED@", "@USERNAME@", "@PASSWORD@", "@NONCE@");
    $values = array("$namespace", "$created", "$username", "$password", "$nonceBase64");
    $request = str_replace($tokens, $values, $template);
    
    return $request;
  }
  
  function send($body, $namespace) {
    $ini = getIni();
    $papiDomainAndContext = $ini['papiDomainAndContext'];
    $username = $ini['username'];
    $passphrase = $ini['passphrase'];
    $envelope = createEnvelope($username, $passphrase, $namespace);
    $request = str_replace('@BODY@', $body, $envelope);
    return sendData($request, $papiDomainAndContext);
  }

  function sendData($request, $papiDomainAndContext) {
    $ch = curl_init($papiDomainAndContext.'/service/');
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: text/xml'));
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $request);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
    $output = curl_exec($ch);
    curl_close($ch);

    return $output;
  }
?>
