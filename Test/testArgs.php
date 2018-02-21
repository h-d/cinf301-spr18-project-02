<?php
require_once "../Model/ParseArgv.php";

$parsed = new ParseArgv($_SERVER['argv']);
$parsedArgs = $parsed->getParsed();


foreach ($parsedArgs as $category=>$type)
{
    print("Category: $category\n");

    foreach ($type as $name=>$values)
    {
        print("Name: $name   Weight: $values\n");
    }
}
