<?php
/**
 * Object of OOP in PHP
 * @author Dariush Hojabrian
 * @author Dariush Hojabrian <dariushhojabrian@gmail.com>
 * @category OOP
 * @version 1.0.0
 */

/**
 * this file covers:
 * Object iteration
 * Iterator interface and it's method
 * IteratorAggregate
 * ++$var and $var++
 * comparing objects with == and ===
 * object references
 * Serializing and unserializing objects
 */


/*
 * Iterate through object properties, from outside and inside class
 */

class SampleClass
{
    public $prop1 = 'property 1, public';
    public $prop2 = 'property 2, public';
    public $prop3 = 'property 3, public';
    protected $prop4 = 'property 4, protected';
    private $prop5 = 'property 5, private';

    function iterateProps()
    {
        echo "iterating through object properties from inside class: \n";
        foreach($this as $key => $value) {
            echo "$key => $value\n";
        }        
    }

}

$obj = new SampleClass();

foreach($obj as $key => $value) {
    echo "$key => $value\n";
}
$obj->iterateProps();

echo "\n\n Iteration: \n";

/**
 * If you want to create an iterator, you may want to implement Iterator interface
 * That will dictate your iterator class how the object will be iterated
 * Then your iterator class need: current, key, next, rewind, valid
 * iterator interface methods take no argument
 * First it will rewind the array, 
 * (2) then checks if element is valid at current position
 * then return current position value
 * then return current position key
 * then goes to next value
 * then repeat from (2)
 */

 class CustomIterator implements Iterator
 {
    //  private $position = 0;
     private $array = [
         "1st element",
         "2nd element",
         "3rd element",
         "4th element"
     ];
     public function __construct($array = [])
     {
         if (!empty($array)) {
             $this->array = $array;
         }
        //  $this->position = 0;
     }

     /**
      * return the current element
      *
      * @return mixed
      */
     public function current()
     {
        echo "getting current \n";
        //  return $this->array[$this->position];
        return current($this->array);
     }

     /**
      * return the key of the current element
      *
      * @return scalar
      */
     public function key()
     {
         echo "getting key \n";
        //  return $this->position;
        return key($this->array);
     }

     /**
      * Move forward to next element
      *
      * @return void
      */
     public function next()
     {
        echo "getting next \n";
         // first add to $this->position then return it.
        //  return  ++$this->position;
        return next($this->array);
     }

     /**
      * rewind the iterator to the first element
      *
      * @return void
      */
     public function rewind()
     {
        echo "rewinding \n";
        //  $this->position = 0;
         reset($this->array);
     }

     /**
      * checks if current position is valid
      *
      * @return bool
      */
     public function valid()
     {
        echo "check if element at current position is valid: \n";
        //  return isset($this->array[$this->position]);
        $key = key($this->array);
        return ($key !== NULL && $key !== FALSE);
     }

 }

 $itObj = new CustomIterator();
 foreach ($itObj as $key => $value) {
     print "$key => $value \n";
 }

 echo "\n\n Iteration Aggregate: \n";
 /**
  * An alternative to Iterator interface is IteratorAggregate interface
  * IteratorAggregate interface only requires getIterator() method that
  * returns an instance of a class implementing Iterator
  */

  /**
   * one of the behaviors that I want of this class is iterating through the elements of it's collection
   */
  class SampleCollection implements IteratorAggregate
  {

    private array $collection = array();
    private int $count = 0;
    public function __construct($array)
    {
        $this->collection = $array;
        $this->count = count($array);
    }
    public function getIterator()
    {
        return new CustomIterator($this->collection);
    }
    public function add($value)
    {
        // first add value to position $this->count then add 1 value to $this->count
        $this->collection[$this->count++]  = $value;
    }

  }
  $myCol = new SampleCollection([]);
  $myCol->add("item 1");
  $myCol->add("item 2");

  foreach ($myCol as $key => $value) {
      echo "key/value: [ $key -> $value ] \n";
  }

  echo "\n\ncomparing objects \n";

  /**
   * == checks for value
   * === checks for value and type
   * == for objects returns true if the two object instances have the same attributes and values
   * and they are instances of the same class
   * === for objects returns true if the two object variable being compared are exactly the same
   * instance of the class
   */


class Flag
{
    public $flag;

    function __construct($flag = true) {
        $this->flag = $flag;
    }
}

class OtherFlag
{
    public $flag;

    function __construct($flag = true) {
        $this->flag = $flag;
    }
}

function bool2str($bool)
{
    if ($bool === false) {
        return 'FALSE'."\n";
    } else {
        return 'TRUE'."\n";
    }
}

$obj1 = new Flag();
$obj2 = new OtherFlag();
$obj3 = new Flag(false);
$obj4 = new OtherFlag(false);
$obj5 = new Flag(true);

/**
 * an Object variable doesn't contain the object itself. 
 * it contains an object identifier which allows object accessors to find the actual object
 * so if an object is sent by argument, returned or assigned to another variable,
 * then the two variable hold a copy of the identifier, and point to the same object
 */
$obj6 = $obj1;

/**
 * create a reference to a variable
 * a reference PHP is an alias, allowing two different variables writing to the same value
 */
$obj7 = &$obj1;

/**
 * will return FALSE, because despite the same attribute and value,
 * $obj1 and $obj2 ARE NOT instances of the same class
 */
echo (bool2str($obj1 == $obj2));

/**
 * will return FALSE, because 
 * $obj1 and $obj3 have not the same value
 */
echo (bool2str($obj1 == $obj2));

/**
 * will return FALSE, because
 * $obj1 and $obj4 ARE NOT instances of the same class and values are different
 */
echo (bool2str($obj1 == $obj4));

/**
 * will return TRUE, because 
 * $obj1 and $obj5 ARE instances of the same class,
 * and have the same attributes and value
 */
echo (bool2str($obj1 == $obj5));

/**
 * will return FALSE, because 
 * $obj1 and $obj5 ARE two different instances
 */
echo (bool2str($obj1 === $obj5));

/**
 * will return TRUE, because 
 * $obj1 and $obj6 ARE the same identifier to actual object
 */
echo (bool2str($obj1 === $obj6));

/**
 * will return TRUE, because 
 * $obj7 is just an alias to $obj1 that both writes to the same instance
 */
echo (bool2str($obj1 === $obj7));


echo "\n\nserializing \n";

/**
 * serialize() return a byte-stream representation of any value that can be stores
 * unserialize() will use the value and recreate the original variable
 * you can serialize an object store it and the unserialize it to bring it back to life
 * only the attributes and class name of an object will be serialized not methods
 * so to recreate the object, it's class mus be defined first.
 */

 class MyClass
 {
     private $prop = 'some value';
     public function getValue()
     {
         echo $this->prop,"\n";
     }
 }

 $aliveObj = new MyClass();
 $aliveObj->getValue();
 $string = serialize(($aliveObj));
 // then you can store $string and recreate the object from it
 $recreated = unserialize($string);
 $recreated->getValue();