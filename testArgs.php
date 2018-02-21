<?php
require_once "./Model/ParseArgv.php";


//Parse args
$parsed = new ParseArgv($_SERVER['argv']);
$parsedArgs = $parsed->getParsed();

//Print parsed args
$parsed->print_Parsed($parsedArgs);



