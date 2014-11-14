<?php


 require_once('vendor/composer/ClassLoader.php');
 require_once('src/qus/validation/tests/testinit.php');
 
 $loader = new Composer\Autoload\ClassLoader();

      // register classes with namespaces
      $loader->add('Monolog', 'vendor/monolog/monolog/src');
      $loader->add('qus', 'src');

      // activate the autoloader
      $loader->register();

      // to enable searching the include path (eg. for PEAR packages)
      $loader->setUseIncludePath(true);

