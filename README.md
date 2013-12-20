php-validation
==============

my first crack at learning PHP back in 2007<br><br>

Coming from a Java background I decided to learn PHP at some point. So, pick something you know and run with it in a different language. This is my first attempt at PHP Validation for a server that we could not access nor add things like php-xml so I had to do a couple of work arounds... :(
<br><br>
7 years later I am revisiting my code and thinking "wow - this needs some serious commenting..." but in the meantime I will simply add it to my git hub with a huge TODO (comment this!).
<br><i>I am commenting classes as I work on them on a case by case basis.</i>
Since I wrote this 7 years ago we can now use basic typecasting on passed objects in PHP, so I'd like to tighten that up when I re-factor this also, allowing me to put some more checks in place.  If I get my linux box set up again at home I can start writing my PHPUnit tests for it - currently using 'wamp' which seems to fall over a lot when it's unhappy.
<br><i>currently adding unit tests on the 'namespacing' branch as the 2 go hand in hand</i>
Also since this time I've learned not to use short tags '<?' and to use a complete tag '<?php' so that will be cleaned up at some point also.
<br><i>currently changing to long tags and removing the closing '?>' for added security</i>
<br><br>
Design Pattern used: Chain of Command

PHPunit test sample command: phpunit UnitTest tests\validation\rules\AlphabetValidatorCommandTest.php
