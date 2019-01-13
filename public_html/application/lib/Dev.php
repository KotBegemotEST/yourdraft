<?php

ini_set('display_errors', 1); // вывод ошибок на экран
error_reporting(E_ALL); // выводить все ошибки

function debug($str){
	echo('<pre>');
	var_dump($str);
	echo('<pre>');
	exit;
}
