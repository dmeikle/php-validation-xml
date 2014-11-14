<?php

namespace tests\Validation;

use Validation\Validator;
use Validation\YamlConfiguration;
use tests\BaseTest;

/**
 * Description of ValidatorTest
 *
 * @author davem
 */
class ValidatorTest extends BaseTest{
   
    public function testCreateValidator() {
        $loader = new YamlConfiguration();        
        $loader->loadConfig(__SITE_PATH . '/validation-config.yml');
        
        $key = 'testURI1';
        $validator = new Validator($loader, $this->getLogger());
        
        $result = $validator->validateRequest($key, $this->getPostedParams());
        $this->assertTrue(is_array($result));
        $this->assertTrue(array_key_exists('firstname',$result));
        $this->assertEquals('VALIDATION_REQUIRED_FIELD', $result['firstname']);
    }
    
    private function getPostedParams() {
        return array(
            'blal' => 'humbug',
            'firstname' => '',
            'lastname' => 'meikle',
            'email' => 'david@quantumunit.com',
            'password' => 'thIs1s@p@$$w0rd'
        );
    }
}
