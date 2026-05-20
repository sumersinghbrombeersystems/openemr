<?php

//  OpenEMR
//  MySQL Config

<<<<<<< HEAD
global $disable_utf8_flag;
$disable_utf8_flag = false;

$host	= 'localhost';
$port	= '3306';
$login	= 'root';
$pass	= '';
$dbase	= 'openemrdb';
$db_encoding	= 'utf8mb4';
=======
$host   = 'localhost';
$port   = '3306';
$login  = 'openemr';
$pass   = 'openemr';
$dbase  = 'openemr';
>>>>>>> e122549fbf2038a5bdf28bcf91fa1189ae5b4676

$sqlconf = [];
global $sqlconf;
$sqlconf["host"]= $host;
$sqlconf["port"] = $port;
$sqlconf["login"] = $login;
$sqlconf["pass"] = $pass;
$sqlconf["dbase"] = $dbase;

//////////////////////////
//////////////////////////
//////////////////////////
//////DO NOT TOUCH THIS///
$config = 1; /////////////
//////////////////////////
//////////////////////////
//////////////////////////
?>
