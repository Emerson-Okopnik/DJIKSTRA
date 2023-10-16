<?php
$sHost      = '127.0.0.1';
$sPort      = '5432';
$sDbName    = 'DJIKSSTRA';
$sUser      = 'postgres';
$sPassword  = 'postgresql';

$sConexao   = "host=$sHost
               port=$sPort
               dbname=$sDbName
               user=$sUser
               password=$sPassword";



try {
  $oConexao   = pg_connect($sConexao);
  echo 'asd1';
} catch(Exception $e) {
   return ("Erro na conexão: " . $oConexao->connect_error);
}
