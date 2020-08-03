<?php
/**
* Traits in PHP
* @author Dariush Hojabrian
* @author Dariush Hojabrian <dariushhojabrian@gmail.com>
* @category OOP
* @version 1.0.0
*/

/*
* this file covers:
* Traits
* use keyword
* Precedence order
* Conflict Resolution
* insteadof and as operator
* Composing Traits
* abstract members and methods in traits
* properties in traits
*/

/*
* Traits are PHP method for multiple inheritance and code reuse
* Traits is used to group functionality in a fine-grained and consistent way
* You cannot instantiate a trait.
* The precedence order of trait and parent class is that:
*   Methods from the current class override Trait Methods,
*   which in turn override inherited methods.
* in case of conflict in traits method, it must be explicitly resolved.
* traits can make use of other traits too so a trait can be composed partially or entirely of other traits
* Traits support abstract methods in order to impose requirements upon the exhibiting class.
*   only the name is required not the it's signature
* Traits can define both static members and static methods.
* Traits can define properties, but the class using the trait, can not defined the same property 
*    unless it is compatible, with same visibility and initial value
*  
*/

trait Trait1
{
    public static $traitStaticMember = 'static variable in trait';

    public function sayHello()
    {
    }
    abstract public function helloWorld();
}
trait Trait2
{
    public function sayGoodbye()
    {
    }

    // trait can use static methods and members
    public static function TraitStaticMethod()
    {
        echo 'This is a static method in trait.',"\n";
    }
}

trait CalculateDistance
{
    // a trait can use other traits too
    use Trait1, Trait2;
    
    public function calculateDistance()
    {
        echo 'distance is 1km.',"\n";
    }
    // this method conflict with the method in another trait
    public function start()
    {
        echo 'Start odometer.',"\n";
    }

    // Abstract method was defined in trait, so it's a requirement for this trait class
    public function helloWorld()
    {
        echo 'Hello World.',"\n";
    }
}
trait CalculateTime
{
    public function calculateTime()
    {
        echo 'it takes 2h to get there.',"\n";
    }
    // conflicting method
    public function start()
    {
        echo 'start chronometer.',"\n";
    }
    // this method has public visibility which be changed to private using as keyword
    public function timerEvent()
    {
        echo 'timer is triggered',"\n";
    }
}

class Distance
{
    // when using the trait in child, this method will be overridden
    public function calculateDistance()
    {
        echo 'distance is 3km.',"\n";
    }

    public function setGPS()
    {
        echo 'GPS is set for the coordinate',"\n";
    }
}

class Move extends Distance
{
    /* 
    * conflict properties must be compatible with the trait property. same visibility and initial value
    * But you can change the value in the context of the class
    */

    public static $traitStaticMember = 'static variable in trait';
    /*
    * to resolve conflict you must choose one method instead of another
    * as operator, adds an alias to the method
    * as keyword can change the visibility too
    */
    use CalculateDistance, CalculateTime {
        CalculateDistance::start insteadof calculateTime;
        CalculateDistance::start as startOdometer;
        CalculateTime::timerEvent as private;
        CalculateTime::timerEvent as private triggerTimer;
    }
    
    // this method override trait method
    public function calculateTime()
    {
        echo 'it takes 1h to get there.',"\n";

        self::$traitStaticMember = 'changes conflict member\'s initial value';
    }
}

$obj = new Move();
$obj->calculateDistance();
$obj->calculateTime();
// Child class now inherits the functionality of both traits and it's parent
$obj->setGPS();

// conflict is resolved in traits and aliased as startOdometer
$obj->startOdometer();

// this will throw an error, as the method triggerTimer is private, using as keyword
// $obj->triggerTimer();

$obj->helloWorld();

Move::TraitStaticMethod();