<?php

switch($_GET['function']) {
  case 'sendUserData': echo executeDB("BEGIN :stringReturn:=PUSER.CREATE_USER_DATA_CERTIFICATE('" . $_GET['snils'] . "', '"
                                                                                                  . $_GET['userData'] . "'); END;"); break;
}

function selectDB($stringQuery) {
  if (!$stringConnection = oci_connect("C##QSECOFR","Ufkfrnbrf","XE","AL32UTF8")) {return json_encode("Error connecting to Database#");}
  $arrReturn = [];
  $stringQuery = ociparse($stringConnection, $stringQuery);
  ociexecute($stringQuery, OCI_DEFAULT);
  while($row = oci_fetch_assoc($stringQuery)) {
    $arrReturn[] = $row;
  }
  return json_encode($arrReturn, JSON_UNESCAPED_UNICODE);
}

function executeDB($stringQuery) {
  if (!$stringConnection = oci_connect("C##QSECOFR","Ufkfrnbrf","XE","AL32UTF8")) {return json_encode("Error connecting to Database#");}
  $stringReturn = "0";
  $stringQuery = ociparse($stringConnection, $stringQuery);
  ocibindbyname($stringQuery,':stringReturn',$stringReturn, 255);
  ociexecute($stringQuery, OCI_DEFAULT);
  oci_close($stringConnection);
  return $stringReturn;
}

?>