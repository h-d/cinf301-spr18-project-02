<?php
require_once "../Model/ParseArgv.php";

$parsed = new ParseArgv($_SERVER['argv']);
$arguments = $parsed->getParsed();
// To get $arguments, you should use:
//      $arguments = $parsed->argv;

foreach ($arguments as $k => $v) {
    print("$k=>$v\n");
}
