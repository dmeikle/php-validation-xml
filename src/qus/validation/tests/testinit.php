<?php


//require_once "PHPUnit/Autoload.php";
//
////require_once DIRECTORY_SEPARATOR .'vendor' . DIRECTORY_SEPARATOR . 'symfony' . DIRECTORY_SEPARATOR . 'class-loader' . DIRECTORY_SEPARATOR . 'Symfony' . DIRECTORY_SEPARATOR . 'Component' . DIRECTORY_SEPARATOR . 'ClassLoader' . DIRECTORY_SEPARATOR . 'UniversalClassLoader.php';
//
//$filePath = getRootDirectory();
//
//$loader = new Symfony\Component\ClassLoader\UniversalClassLoader();
//$loader->registerNamespaces(
//    array(
//        'validation'   => $filePath . DIRECTORY_SEPARATOR . 'src'. DIRECTORY_SEPARATOR ,
//        'tests'        => $filePath . DIRECTORY_SEPARATOR .  'tests'. DIRECTORY_SEPARATOR ,
//      ));
//$loader->register();


function getRootDirectory() {
	$site_path = realpath(dirname(__FILE__));

	$chunks = explode(DIRECTORY_SEPARATOR, $site_path);
	array_pop($chunks);
	
	return implode(DIRECTORY_SEPARATOR, $chunks);
	
}
