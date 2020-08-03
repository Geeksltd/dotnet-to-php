<?php
/**
 * Magic methods of OOP in PHP
 * @author Dariush Hojabrian
 * @author Dariush Hojabrian <dariushhojabrian@gmail.com>
 * @category OOP
 * @version 1.0.0
 */

/**
 * this file covers:
 * Magic methods
 * Overloading(Dynamically creating properties and methods)
 * define multiple properties in a single line
 * var_dump
 * var_export
 * eval
 * array_key_exists
 * implode
 * clone
 */


/*
 * Magic methods starts with __, and must be declared as public
 * Magic methods include: __construct(), __destruct(), __call(), __callStatic(), __get(), 
 *    __set(), __isset(), __unset(), __sleep(), __wakeup(), __serialize(), __unserialize(),
 *    __toString(), __invoke(), __set_state(), __clone() and __debugInfo()
 */

class DBConnection
{
    protected $link;
    //you can define multiple properties by separating them with comma.
    private $dsn;
    private $username;
    private $password;
    public $cloned = 'this object';

    /**  overloaded data.  */
    private $data = array();

    public function __construct($dsn, $username, $password)
    {
        $this->dsn = $dsn;
        $this->username = $username;
        $this->password = $password;
        $this->connect();
    }
    public function connect()
    {
        $this->link = 'pdo connection';
        echo 'Connecting to PDO',"\n";
    }

    /**
     * called when want to serialize class using serialize() method.
     * sleep magic method is responsible for cleanup task and commit pending data
     *
     * @return array all variables of the object to be serialized
     */
    public function __sleep(): array
    {
        echo 'serializing the object',"\n";
        return array('dsn', 'username', 'password');
    }

    /**
     * called when want to unserialize class using unserialize() method.
     * wakeup magic method is responsible for reconstructing any resources or initialization
     * like connecting to database
     */
    public function __wakeup()
    {
        echo 'unserializing the object and return it back to life',"\n";
        $this->connect();
    }

    /**
     * this method is called when serializing the class.
     * With existence of this method, __sleep will be ignored
     * __serialize create a serialization-friendly arbitrary representation of the object
     *
     * @return array key/value pair of object properties
     */
    public function __serialize(): array
    {
        echo 'serializing the object with __serialize',"\n";
        return [
            'dsn' => $this->dsn,
            'user' => $this->username,
            'pass' => $this->password,
        ];
    }

    /**
     * this method will get the restored array from  __serialize(),
     * and then this array will be used to restore properties of the object and reinitialize the object
     *
     * @param array $data
     *
     * @return void
     */
    public function __unserialize(array $data): void
    {
        echo 'unserialize the object with __unserialize',"\n";
        $this->dsn = $data['dsn'];
        $this->username = $data['user'];
        $this->password = $data['pass'];
        $this->connect();
    }

    /**
     * this method allows a class to decide how it will react when it is treated like a string
     * like when you want to print an object
     *
     * @return string the printable part of the class
     */
    public function __toString(): string
    {
        return $this->link;
    }

    /**
     * this method is called when a script tries to call an object as a function
     * 
     * @param mixed $params
     */
    public function __invoke($params)
    {
        // var_dump dumps information about a variable
        var_dump($params);
    }

    /**
     * this is static method
     * called when an object of class is exported by var_export()
     * 
     * @param array $properties containing exported properties
     * 
     * @return object exported representation of the object
     */
    static function __set_state($properties): object
    {
        $obj = new DBConnection('dsn', 'my_name', 'secret');
        $obj->dsn = $properties["dsn"];
        return $obj;
    }

    /**
     * This method is called when trying to dump object information (var_dump)
     * to get the properties that should be shown.
     * if debugInfo is not defined, all the public,protected and private properties of the object
     * will be showed. 
     */
    public function __debugInfo(): array
    {
        return [
            'link' => $this->link,
            'dsn' => $this->dsn
        ];
    }

    /**
     * When cloning an object, this method will be called to determine the 
     * clone behavior. 
     * When cloning PHP will run a shallow copy of the objects properties. 
     * then __clone of the object is called that allow any necessary properties that
     * need to be changed
     */
    public function __clone()
    {
        $this->cloned = 'clone object';
    }


    /**
     * Overloading
     * Overloading magic methods are: 
     * __call, __callStatic => method overloading
     *  __get, __set, __isset, __unset => property overloading
     * these methods should not be declared static(works in object context)
     * overloading methods are called when interacting with properties or methods that 
     * have not been declared or are not visible in the current scope
     * The word Overloading in PHP is different from other languages.
     * in other languages, overloading is the ability to have multiple methods with the same 
     * name but different signature.
     */

     /**
      * __get is called when trying to read data from inaccessible/non-existing properties
      * 
      * @param string $name name of the property
      *
      * @return mixed 
      */
      public function __get($name)
      {
          if (array_key_exists($name, $this->data)) {
              return $this->data[$name];
          }
          return null;
      }

      /**
       * __set writing data to inaccessible/non-existing properties
       * 
       * @param string $name name of the property
       * @param mixed $value the value of the property
       */
      public function __set($name, $value)
      {
          $this->$name = $value;
          // or
          $this->data[$name] = $value;
      }

      /**
       * __isset triggered when isset/empty function is called on
       * inaccessible/non-existing property
       * @param string $name name of the property to check
       */
      public function __isset($name)
      {
          echo "checking if $name set: ","\n";
          return isset($this->data[$name]); // Determine if a variable is declared and is different than NULL
      }

      /**
       * __unset is invoked when unset function is used on inaccessible/non-existing properties
       * @param string $name name of the property to unset
       */
      public function __unset($name)
      {
          echo "Unsetting $name : ","\n";
          unset($this->data[$name]); // destroys the specified variables
      }
      
      /**
       * __call is triggered when invoking inaccessible methods in object context
       * @param string $name the name of the method being called
       * @param array $arguments an enumerated array containing the parameters passed to the $name 'ed method
       */
      public function __call($name, $arguments)
      {
             // Note: value of $name is case sensitive.
             echo "Calling object method '$name' "
                . implode(', ', $arguments). "\n";// implode join array elements with string delimiter
      }

      /**
       * __callStatic is triggered when invoking inaccessible methods in static context
       * @param string $name the name of the method being called
       * @param array $arguments an enumerated array containing the parameters passed to the $name 'ed method
       */
      public function __callStatic($name, $arguments)
      {
             // Note: value of $name is case sensitive.
             echo "Calling object method '$name' "
                . implode(', ', $arguments). "\n";
      }


}