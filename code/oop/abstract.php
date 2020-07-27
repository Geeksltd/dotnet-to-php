<?php
/**
* Abstraction and Interface in PHP
* @author Dariush Hojabrian
* @author Dariush Hojabrian <dariushhojabrian@gmail.com>
* @category OOP
* @version 1.0.0
*/

/*
* this file covers:
* Abstract classes and methods
* method signature
* Null or optional argument
* Define Interfaces
* using class constants
* multiple inheritance in interfaces
* override properties
*/

/*
* abstract classes can not be instantiated
* any class with at least one one abstract method must be abstract
* abstract methods just declares method's signature and visibility, no implementation
* also applies to constructor
*/
abstract class AbstractClass
{
    protected string $title = "abstract property";
    /**
    * define an abstract method
    * the method in child class must be protected/public.
    * must take one argument of type string or NULL
    * abstract method only need to define the required arguments
    *
    * @param ?string $name Name or Null
    */
    abstract protected function sayHelloTo(?string $name);
}

/*
* An interface defines how the world see the class.
* contains public methods without implementation
* interfaces can not have member variables
*/
interface iTemplate
{
    // constants can not be overridden in classes that implements interface
    const SOME_CONSTANT = "this is a constant in class";

    // not working, no properties in interface
    // public int $vra = 10;
    public function setTitle(string $title);
}
interface iTemplate2
{
}

/*
* Interfaces can be extended like classes
* Only interfaces can extend from multiple super classes
*/
interface iTemplateChild extends iTemplate, iTemplate2
{
    public function getTitle(): string;
}

// multiple interfaces for a class
interface iSecondTemplate
{
    public function setParagraph($paragraph);
}

/*
* Concrete class must follow the signature of abstract method
* by implementing an interface this class must implements methods in interface
* Classes may implement more than one interface
*/
class ConcreteClass1 extends AbstractClass implements iTemplateChild, iSecondTemplate
{
    // can not override interface constant
    // const SOME_CONSTANT = "not working";

    /*
    * setTitle was in the interface that this class implements,
    * So this method must exist in this class with the same signature.
    */
    public function setTitle(string $title)
    {
        // title is coming from parent class(abstractClass)
        echo $this->title."\n";
        $this->title = strtoupper($title);
    }

    public function getTitle(): string
    {
        echo $this->title;
        return $this->title;
    }

    public function setParagraph($paragraph)
    {
    }

    /**
    * must follow the signature, so ?string is necessary
    * But can have more argument.
    * @param ?string $name Name or Null
    * @param string $time Optional argument, H:m time
    */
    public function sayHelloTo(?string $name, $time = null)
    {
        echo "Good Morning $name $time \n ";
    }
}

(new ConcreteClass1())->sayHelloTo('Everyone', ', current time is: ' . date('H:m'));
(new ConcreteClass1())->sayHelloTo(null);
$obj = new ConcreteClass1();
$obj->setTitle('Interface in OOP');
$obj->getTitle();
