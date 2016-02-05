php-validation
==============

my first crack at switching from Java to learn PHP back in 2007<br><br>

Coming from many years in a Java background I decided to learn PHP at some point. So, pick something you know
 and run with it in a different language. This is my first attempt at PHP Validation for a server that we could 
 not access nor add things like php-xml so I had to do a couple of work arounds... :(
<br><br>
Many years later (December 2013) I am revisiting my code and thinking "wow - this needs some serious commenting..." 
but in the meantime I will simply add it to my git hub with a huge TODO (comment/refactor this library!).

<br><strong>I am commenting classes as I work on them on a case by case basis.</strong>

Since I wrote this 7 years ago we can now use basic typecasting on passed objects in PHP, so I'd like to tighten 
that up when I re-factor this also, allowing me to put some more checks in place.  I began writing my PHPUnit tests 
for it the other day - have MOST of the classes under coverage now.

<br><strong>currently adding unit tests and namespacing throughout the library a little bit at a time so you may see 
some classes commented/unit tested and some not - I'm coming back at this code to clean it up as a demonstration 
of newer coding standards - both online as well as my own... you may see things slow down in my progress as I 
am doing this during my evenings as a proof of concept project at this point</strong>

<br><br>
Also since this 2007 I've learned not to use short tags '<?' and to use a complete tag '<?php' so that will be 
cleaned up at some point also.
<br><strong>currently changing to long tags and removing the closing '?>' for added security</strong>
<br><br>
Design Pattern used: Chain of Command

PHPunit test sample command (for WAMP) for single class testing (without Ant): <br>
phpunit UnitTest tests\validation\rules\AlphabetValidatorCommandTest.php
