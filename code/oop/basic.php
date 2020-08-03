<?php
/**
 * Basic OOP
 * @author Dariush Hojabrian
 * @author Dariush Hojabrian <dariushhojabrian@gmail.com>
 * @category OOP
 * @version 1.0.0
*/

/*
* this file covers:
* Defining class,
* property, method
* property default value
* sending argument(fixed and dynamic),
* access modifiers(visibility),
* constructor, destructor,
* create object(class instance), object assignment,
* late binding
* replicate objects, reference
*/

// This is a service class that will be injected into other classes.
class ServiceClass
{

    /**
    * Add two numbers
    *
    * @param float $num1 First number to add
    * @param float $num2 Second number to add
    *
    * @return float Returns sum of the two arguments
    */
    public function addTwoNumbers($num1, $num2)
    {
        return $num1 + $num2;
    }

    /**
    * Take any number of argument and sum them together
    *
    * @param float[] $args Array of numbers to add
    *
    * @return float Returns sum of arguments
    */
    public function addMultipleNumbers($args)
    {
        $sum = 0;
        foreach ($args as $arg) {
            $sum += $arg;
        }
        return $sum;
    }
}

class SimpleClass
{

    // declare a property and set a default value
    // Class properties and methods live in separate "namespaces",
    // so it is possible to have a property and a method with the same name.
    private $var = 'a default value';
    private $num = 2;
    public $name;
    public ServiceClass $addService;
    private $service = 'ServiceClass'; # Late Binding in PHP
    public ServiceClass $addServiceLate;
    // define a static member
    public static int $static_num = 100;


    // constructor
    public function __construct()
    {
        // initializing a class in constructor to inject it in this class.
        $this->addService = new ServiceClass();

        // Create instance of class usign Late Binding
        $this->addServiceLate = new $this->service();
    }

    // method declaration. no modifier means public
    public function displayVar()
    {
        echo "\ndisplay class property \$var: " . $this->var; # $this is a reference to the object calling
    }

    // Adding Two numbers by calling a service class
    public function addNumbers(...$args)
    {
        if (func_num_args() == 2) {
            return $this->addServiceLate->addTwoNumbers($args[0], $args[1]);
        }
        return $this->addService->addMultipleNumbers($args);
    }

    /**
    * Create new instance of class with static keyword
    */
    public static function getNewInstance()
    {
        return new static; // static refers to current class
    }

    // destructor
    public function __destructor()
    {
    }
}
// creating new object of class. and calling it's public method/properties
$obj = new SimpleClass();
echo "static member: ",$obj::$static_num,"\n";
$obj->displayVar();
echo "Adding 20 + 19 = ". $obj->addNumbers(20, 19);
echo "\n Adding 1 + 2 + 3 + 4 + 5 + 6 + 7 = ". $obj->addNumbers(1, 2, 3, 4, 5, 6, 7);
// private properties can not be access from outside.
// echo "\n $obj->num"; will cause a fatal error

// duplicate an object, same as passing instance to a function
$dup_obj = $obj;
// or you can use clone
$clone_obj = clone($obj);

// Creating a reference to the object
$ref_obj  =& $obj;
$ref_obj->displayVar();

// different ways of creating new object
$new_obj = new $obj();
//use :: to call static methods.
$new_obj_from_class = SimpleClass::getNewInstance();
// create object and use it in a single expression
(new SimpleClass())->displayVar();
