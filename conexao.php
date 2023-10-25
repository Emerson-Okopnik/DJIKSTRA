<?php
$sHost      = '127.0.0.1';
$sPort      = '5432';
$sDbName    = 'dijkstra';
$sUser      = 'postgres';
$sPassword  = '123';

$sConexao   = "host=$sHost
               port=$sPort
               dbname=$sDbName
               user=$sUser
               password=$sPassword";

try {
  $oConexao   = pg_connect($sConexao);
} catch(Exception $e) {
   return ("Erro na conexão: " . $oConexao);
}
