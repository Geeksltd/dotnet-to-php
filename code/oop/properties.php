<?php
/**
* Properties and visibility in PHP
* @author Dariush Hojabrian
* @author Dariush Hojabrian <dariushhojabrian@gmail.com>
* @category OOP
* @version 1.0.0
*/

/*
* this file covers:
* Properties
* visibility
* $this
* initialization
* heredoc and nowdoc
* Constructor and Destructor
*/

/*
* Class member variables are called properties(also called attributes/fields)
* properties must have visibility, type is optional and you may initialize them
* but this initialization must be a constant value(able to be evaluated at compile time not run time)
*/

class BaseClass
{
    public function __construct()
    {
        print "Parent Constructor".PHP_EOL;
    }
}

class SimpleClass extends BaseClass
{
    // basic, visibilities: public, protected, private
    public $prop;
    //from php-7.4
    private string $title = "simple";

    // invalid property declarations:
//    public $prop = self::myStaticMethod();

    public $prop2 = <<<EOT
This is a heredoc string, acts like double quoted strings.
the closing identifier must appear in the first column of the line
you can parse variables inside heredoc.
EOT;

    public $prop3 = <<<'EOD'
This is Nowdoc string, single quoted strings.
no parsing is done in Nowdoc
EOD;

    /*
    * As of PHP 7.4.0, property definitions can include a type declaration.
    * Types are: bool, int, float, string, array, object, iterable, self, parent, Class/Interface name, ?type
    * iterable: Array or instance of Traversable
    * self/parent: property must be an instance of the same class/ instance of the parent
    * Class/Interface name: property must be an instance of the given class / interface
    * ?type: the property must of specified type of NULL
    */
    private int $typedProp = 2;

    /*
    * will be called on each newly-created objects
    * suitable for object initialization
    */
    public function __construct()
    {
        // calling parent constructor,
        // if child has no constructor, it will inherit it from it's parent
        parent::__construct();
        print "Child Constructor".PHP_EOL;
    }

    // when there is no visibility, it will be defined as public
    public function noVisibility()
    {
        // $this is a reference to the calling object
        echo $this->title;
    }

    /*
    * Destructor will be called as soon as there are no other references to a particular object
    * The destructor will be called even if script execution is stopped
    * you can not throw an exception in destructor
    */
    public function __destruct()
    {
        print "Destructor of ". __CLASS__ .PHP_EOL;
    }
}
$obj = new SimpleClass();

/*
* Objects of the same type will have access to each others private and protected members
* even though they are not the same instances
*/
