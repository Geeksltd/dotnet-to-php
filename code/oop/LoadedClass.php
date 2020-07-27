<?php

/**
* AutoLoad in PHP
* @author Dariush Hojabrian
* @author Dariush Hojabrian <dariushhojabrian@gmail.com>
* @category OOP
* @version 1.0.0
*/


/*
* This class will be loaded by autoloaders in scope.php
* then name of the class and the file name must be the same
*/
class LoadedClass
{
    const MY_CONSTANT = 'simple constant';
    public $prop = 2;
    public function simpleMethod()
    {
        echo 'class is autoloaded',"\n";
    }
}

class ChildClass extends LoadedClass
{
    const MY_CONSTANT = 'child simple constant';
    public static $title = 'Hello World';

    public static function getValues()
    {
        // get constant from parent
        echo parent::MY_CONSTANT,"\n";
        // get constant from this class
        echo self::MY_CONSTANT,"\n";
        // get static member from this class
        echo self::$title,"\n";
        // static:: will find the first occurrence of the property/method in child or parent
        echo static::MY_CONSTANT,"\n";
    }
}

/*
* Scope Resolution Operation ::
* allows access to static, constants, and overridden properties or methods of a class
* from outside of class: ClassName::property/method
* from inside use: self,parent or static keywords
*/

echo LoadedClass::MY_CONSTANT,"\n";
ChildClass::getValues();
