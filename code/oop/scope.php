<?php
/**
* Scopes and AutoLoad in PHP
* @author Dariush Hojabrian
* @author Dariush Hojabrian <dariushhojabrian@gmail.com>
* @category OOP
* @version 1.0.0
*/

/*
* this file covers:
* Autoload classes instead of include
* Scopes
* try/catch block
* using self, parent, static
*/

/*
* Classes must be defined before used.
* Usually a class is defined per file. so need to include the class file before use.
* spl_autoload_register() register autoloaders, enables classes to be loaded.
* Autoloading is not available if using PHP in CLI interactive mode.
*/

spl_autoload_register(function ($class_name) {
    if (file_exists('code/oop/'.$class_name.'.php')) {
        include $class_name.'.php';
    } else {
        throw new Exception("Unable to load $class_name.");
    }
});

/*
* When class LoadedClass is called, it has not been defined before,
* but, before php fails with an error, it will check autoloaders to see if class was loaded
* so the class is now included in this file.
* we use try/catch block here to load the class
*/
try {
    $obj = new LoadedClass();
    $obj->simpleMethod();
} catch (Exception $e) {
    echo $e->getMessage(), "\n";
}

try {
    $obj2 = new NonLoadableClass();
} catch (Exception $e) {
    echo $e->getMessage(), "\n";
}
