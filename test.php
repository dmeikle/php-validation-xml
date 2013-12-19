<?php




$site_path = realpath(dirname(__FILE__));
 define ('__SITE_PATH', $site_path);
 
echo __SITE_PATH .'\vendor\symfony\class-loader\Symfony\Component\ClassLoader\UniversalClassLoader.php';
echo "\r\n";
require_once __SITE_PATH .'\vendor\symfony\class-loader\Symfony\Component\ClassLoader\UniversalClassLoader.php';
echo __SITE_PATH . '\src\managers' ."\r\n";
$loader = new Symfony\Component\ClassLoader\UniversalClassLoader();
$loader->registerNamespaces(
    array(
        'managers'   => __SITE_PATH . '\src\managers',
        'objects'          => __SITE_PATH . '\src\objects',
        'rules'      => __SITE_PATH . '\src\rules',
        'tests'          => __SITE_PATH . '\tests'
      ));
$loader->register();

require_once "PHPUnit/Autoload.php";
$fileToRun = $argv[1];
$fullpath = __DIR__ . DIRECTORY_SEPARATOR . 'tests' . DIRECTORY_SEPARATOR . $fileToRun;
include_once($fullpath);
echo $fullpath;
echo "\r\n";


// Run a single test by method name
//$test = new \MyApp\MyModule\TestHelloWorld('testTalk');
// Run all tests by reflection class
$test = new \ReflectionClass(new $fileToRun);

PHPUnit_TextUI_TestRunner::run($test);