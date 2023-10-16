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

$oConexao   = pg_connect($sConexao);

