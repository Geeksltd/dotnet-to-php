<?php
/**
* Inheritance in PHP
* @author Dariush Hojabrian
* @author Dariush Hojabrian <dariushhojabrian@gmail.com>
* @category OOP
* @version 1.0.0
*/

/*
* this file covers:
* Extending class,
* Overriding methods
* using final keyword
* using parent::
* using ::class
* protected visibility
*/

class ParentClass
{
    public function sayHello()
    {
        echo "\n say Hello from Parent";
    }

    // only visible to child class
    protected function sampleMethod()
    {
        return 'protected';
    }
    //using final keyword to stop overriding
    final public function sayFinalWord()
    {
        echo "\n final method can not be overridden";
    }
}

/*
* extending properties and methods from ParentClass
* a class can only inherit from one base class
* no Multiple Inheritance
*/
class ChildClass extends ParentClass
{
    /*
    * Overriding parent method.
    * must have the same signature, except for constructor
    */
    public function sayHello()
    {
        echo "\n say hello from child";
        // calling parent properties of overridden methods
        parent::sayHello();
        parent::sayFinalWord();

        // get fully qualified name of class
        echo "\n".ChildClass::class;

        // calling protected method from parent
        echo "\n".parent::sampleMethod();
    }
}

$c_obj = new ChildClass();
$c_obj->sayHello();
$p_obj = new ParentClass();
$p_obj->sayHello();
