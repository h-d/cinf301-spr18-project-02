<?php
require_once "../Model/ParseArgv.php";

$parsed = new ParseArgv($_SERVER['argv']);
$parsedArgs = $parsed->getParsed();


foreach ($parsedArgs as $category=>$type)
{
    print("\n$category\n");

    if($category == 'FLAGS')
    {
        foreach ($type as $name => $value)
        {
            $tempval = preg_replace('/\-/',"",$value);
            print("'$tempval'\n");
        }
    } else {

        foreach ($type as $name => $arg) {

            $integer = 0;
            $tempname = preg_replace('/\-/', "", $name);

            print("'$tempname' => ");

            $fullstring = " ";

            foreach ($arg as $item => $value) {
                $fullstring = $fullstring . "[$item] '$value', ";
                $integer = $item + 1;
            }

            $partstring = substr($fullstring, 0, -2);
            print($partstring);

            if ($integer > 1) {
                print(" ($integer arguments)\n");
            } else print(" ($integer argument)\n");
        }
    }
}
