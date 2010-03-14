<?php

set_include_path('F:/mySandBox/myLuckNumber/Web/' . PATH_SEPARATOR . 'F:/mySandBox/myLuckNumber/Web/');

$basePath=dirname(__FILE__);
$assetsPath=$basePath.'/assets';
$runtimePath=$basePath.'/protected/runtime';

if(!is_writable($assetsPath))
	die("Please make sure that the directory $assetsPath is writable by Web server process.");
if(!is_writable($runtimePath))
	die("Please make sure that the directory $runtimePath is writable by Web server process.");

require 'bootstrap.php';

$application=new TApplication;
$application->run();

?>