php-validation
==============

my first crack at learning PHP back in 2007. Rewritten to use YAML instead of XML

usage:
$loader = new YamlConfiguration();        
$loader->loadConfig(__SITE_PATH . '/validation-config.yml');

//YAML key
$key = 'new_user_signup';
$validator = new Validator($loader, $this->getLogger()); //Monolog\Logger

$result = $validator->validateRequest($key, $this->getPostedParams());


sample YAML config:

new_user_signup:
    - firstname:
        - 
            class: Required      
            failkey: VALIDATION_REQUIRED_FIELD
        - 
            class: String    
            failkey: VALIDATION_INVALID_STRING
            params:
                maxlength: 20
                
    - lastname:
        - 
            class: Required       
            failkey: VALIDATION_REQUIRED_FIELD         
        - 
            class: String
            failkey: VALIDATION_INVALID_STRING
            params:
                maxlength: 20
                
    - email:
        - 
            class: Required     
            failkey: VALIDATION_REQUIRED_FIELD
        -
            class: Email
            failkey: VALIDATION_INVALID_EMAIL
            params:
                - maxlength: 50 
            
    - password:
        - 
            class: Required      
            failkey: VALIDATION_REQUIRED_FIELD          
        - 
            class: Password
            failkey: VALIDATION_INVALID_PASSWORD
            params:
                maxlength: 20
            
            
