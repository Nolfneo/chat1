<?php
session_start();
//запускаю загрузчик
error_reporting(E_ALL);
define("Q_PATH",dirname(__FILE__));

include Q_PATH.'/application/bootstrap.php';
