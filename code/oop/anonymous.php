<?php
/**
* Anonymous of OOP in PHP
* @author Dariush Hojabrian
* @author Dariush Hojabrian <dariushhojabrian@gmail.com>
* @category OOP
* @version 1.0.0
*/

/*
* this file covers:
* Anonymous classes
* difference with normal class
* initialize anonymous class
*/


/*
* Anonymous classes have no name and are useful when simple, one-off object is needed
* Anonymous classes are like normal classes, so they can have properties, extend, use trait, implement interfaces, ...
*/


// This is a normal class definition
class Logger
{
    private int $log_number;
    public function __construct($log_number)
    {
        $this->log_number = $log_number;
    }
    public function log($msg)
    {
        echo $msg . ", Log num: $this->log_number", "\n";
    }
}
// creating an object and calling method in a single line
(new Logger(1))->log('instantiation and call method in a single expression');

/* 
* anonymous class with no name, is defined when needed
* using: new class 
* here we define the class, create an instance and called a method in single expression
* Objects of the same anonymous class declaration are instances of that very class
*/
(new class {
    public function log($msg)
    {
        echo $msg,"\n";
    }
})->log('this is an anonymous class, What\'s the name!!?');

/*
* Anonymous class with constructor and initial value
* anonymous classes are assigned a name by the engine
* to send anonymous class an initial value use new class(value)
*/
$ano_class_obj = new class(2) {

    private int $log_number;
    public function __construct($log_number)
    {
        $this->log_number = $log_number;
    }
    public function log($msg)
    {
        echo $msg . ", Log num: $this->log_number", "\n";
    }
    public function getClassName()
    {
        echo "class name is: ". __CLASS__ ,"\n";
    }
};
$ano_class_obj->log('Anonymous classes are like normal classes but have no name');
$ano_class_obj->getClassName();