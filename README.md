# C# -> PHP (cheat sheet!)
This is a quick reference guide for experienced C# .NET developers to transfer their skills to PHP (Symfony framework).  
It's not a basic tutorial PHP and is not intended for people who are new to programming.

### PHP Standards Recommendations
For this project we use PHP 7.4+  
PHP comes with a best coding standard. You are highly recommended to follow these standards.  
you can find PHP standards recommendation in [here](https://www.php-fig.org/psr/).  

#### Commenting and Documentation
It's super important to add comments to files, classes, methods and everything that is in your code, To clarify and help collaboration.  
you need to follow commenting standards.  
[comment format](https://gist.github.com/ryansechrest/8138375#6-comments) ,  
[PHPDocumentator](https://docs.phpdoc.org/latest/)  

## Language & OO
Title | C# | PHP | Comments
--- | --- | --- | --
Define a class | `public class MyClass { }` | `class MyClass { }`
Class constructor | `public MyClass() { }` | `public function __construct() { }` | magic methods starts with __
Class destructor | `~MyClass() { }` | `public function __destructor() { }`
Access Modifier/Visibility | `public, protected, private, internal` | `public, protected, private` | internal is not defined. if not declared => public
Declare a class property | `public string Name; ` | `public ?string $name;` | Variables names are prefixed with $. also called attributes
Declare a class property with initial value | `public string Name = "Jack"; ` | `public $name = 'Jack';` | property types can be inferred
Declare a class member/method | `public void myMethod() { }` | `public function myMethod()` | no return is void
Declare a method with params and return | `public int myMethod(int param)` | `public function myMethod(int $param): int`
Method with dynamic number of params | `public void myMethod(params int[] list)` | `public function myMethod(...$arg)` | ... declares $arg as array. parameter or argument
Create object | `MyClass myObj = new MyClass();` | `$my_obj = new MyClass();` | $var_name is more conventional than $varName
Create Object with Initialization | `MyClass myObj = new MyClass("initial")` | `$my_obj = new MyClass("initial")` | through constructors
Call object's method | `myObj.myMethod();` | `$myObj->myMethod();` | -> is used to access class members
Create Static members | `public static int num;` | `public static int $num` | both methods and properties
Call static members | `MyClass.num` | `MyClass::$num` | :: to access static members

## Exception handling

## Strings

## Numbers

## Boolean logic

## Date and time

## Program flow

## Collections

## LINQ

## Primitives

## Files

## Json

## Xml

## Database
