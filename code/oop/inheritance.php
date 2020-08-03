<?php
/**
* Inheritance in PHP
* @author Dariush Hojabrian
* @author Dariush Hojabrian <dariushhojabrian@gmail.com>
* @category OOP
* @version 1.0.0
*/

/**
 * this file covers:
 * Extending class,
 * Overriding methods
 * using final keyword
 * using parent::
 * using ::class
 * protected visibility
 * Covariance and Contravariance
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

        /**
         * get fully qualified name of class
         * ::class is a constant contains class full name 
         */
        echo "\n".ChildClass::class;

        // calling protected method from parent
        echo "\n".parent::sampleMethod();
    }
}

$c_obj = new ChildClass();
$c_obj->sayHello();
$p_obj = new ParentClass();
$p_obj->sayHello();

/**
 * Covariance Allow a child's method to return more specific type than the type of its parent method
 * Contravariance allows a parameter type to be less specific in a child method, than of its parent
 */

abstract class Animal
{
    protected string $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    abstract public function speak();
}
class Cat extends Animal 
{
    public function speak(){}
}
interface AnimalShelter
{
    //adopt method return type Animal(more general), and Cat is more specific type
    public function adopt(string $name): Animal;
}

class CatShelter implements AnimalShelter
{
    // Covariance: instead of returning class type Animal, it can return class type Cat(more specific)
    public function adopt(string $name): Cat 
    {
        return new Cat($name);
    }
}

class Food {}

class AnimalFood extends Food {}

abstract class Animal2
{
    protected string $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    //eat is getting a general type AnimalFood and Food is a more general (less specific) type of AnimalFood
    public function eat(AnimalFood $food){}
}

class Dog extends Animal2
{
    // Contravariance: eat method take parameter with less specific type than its parent
    public function eat(Food $food){}
}
