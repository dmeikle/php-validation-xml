<?php
namespace tests\validation\rules;

require_once  DIRECTORY_SEPARATOR . 'tests' . DIRECTORY_SEPARATOR . "testinit.php";

use validation\managers\ValidatorManager;

 
class ValidatorManagerTest extends \PHPUnit_Framework_TestCase
{
	
	 
	 
    public function testValidateForm() {
        $filepath = getRootDirectory() . DIRECTORY_SEPARATOR . 'tests' . DIRECTORY_SEPARATOR .
			'validation' . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'validation-rules.xml';
			
		$mgr = new ValidatorManager($filepath);
		
		//first pass in invalid params
		$uri = 'test2.php';
		$form = null;
		try{
			$mgr->validateForm($form,$uri);
			$this->fail('form should have thrown an exception for invalid Form');
			
		}catch(\Exception $e) {
			$this->assertEquals($e->getCode(), 5070);
		}
		
		//first pass in valid uri with invalid form
		$uri = 'no existing URI';
		$form = array('firstname'=>'test','lastname'=>'smith');
		try{
			$mgr->validateForm($form,$uri);
			$this->fail('form should have thrown an exception for invalid URI');
		}catch(\Exception $e) {
			$this->assertEquals($e->getCode(), 5060);
		}
		
		//first pass in valid uri with invalid form parameter
		//not going to test every rule since there are separate unit tests
		//for each of those already
		$uri = 'test2.php';
		$form = array('firstname'=>'test12','lastname'=>'smith', 'likes'=>array('long walks', 'happy people1', 'puppies'));
		try{
			$result = $mgr->validateForm($form,$uri);
			
			$this->assertTrue(is_array($result));
			$this->assertTrue(count($result) > 0);
			
			//this should return invalid firstname and the failed test parameter 'String'
			$this->assertTrue(array_key_exists('firstname', $result));
			//check the array validation
			$this->assertTrue(array_key_exists('likes', $result));
			
		}catch(\Exception $e) {
			$this->fail($e->getMessage());
		}
		
		
	
    }
	
}