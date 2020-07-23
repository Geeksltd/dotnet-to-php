# C# -> PHP (cheat sheet!)
This is a quick reference guide for experienced C# .NET developers to transfer their skills to PHP (Symfony framework).
It's not a basic tutorial PHP and is not intended for people who are new to programming.

### PHP Standards Recommendations
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
Class constructor | `public MyClass() { }` | `public function __construct() { }`
Declare a class field | `public string Name; ` | `public ?string $Name;` | Variables names are prefixed with $
Declare a class field with initial value | `public string Name = "Jack"; ` | `public $Name = 'Jack';' | Class field types can be inferred.

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
