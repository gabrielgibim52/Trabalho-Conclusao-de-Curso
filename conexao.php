<?php 
  $serverName = "localhost"; //serverName\instanceName

  // Since UID and PWD are not specified in the $connectionInfo array,
  // The connection will be attempted using Windows Authentication.
  $connectionInfo = array( "Database"=>"GeekFest");
  $conn = sqlsrv_connect( $serverName, $connectionInfo);
  
  if( $conn ) {
       echo "Conexão Realizada com sucesso.<br />";
  }else{
       echo "Erro: Sem conexão com banco de dados.<br />";
       die( print_r( sqlsrv_errors(), true));
  }

?>
