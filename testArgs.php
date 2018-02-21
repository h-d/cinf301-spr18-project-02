<?php
require_once "./Model/ParseArgv.php";


//Parse args
$parsed = new ParseArgv($_SERVER['argv']);
$parsedArgs = $parsed->getParsed();


foreach ($parsedArgs as $category=>$type)
{
    print("\n$category\n");

    //if category is flags, only print the flag values
    if($category == 'FLAGS')
    {
        foreach ($type as $name => $value)
        {
            //replace dashes with '' and print
            $tempval = preg_replace('/\-/',"",$value);
            print("'$tempval'\n");
        }

    //if the category is not flags, print the name and the args belonging to the name
    } else {


        foreach ($type as $name => $arg) {

            $integer = 0;
            $tempname = preg_replace('/\-/', "", $name);

            print("'$tempname' => ");

            $fullstring = " ";


            //create temp string with all values
            foreach ($arg as $item => $value) {
                $fullstring = $fullstring . "[$item] '$value', ";
                $integer = $item + 1;
            }

            //remove final comma and print
            $partstring = substr($fullstring, 0, -2);
            print($partstring);

            //print # of args
            if ($integer > 1) {
                print(" ($integer arguments)\n");
            } else print(" ($integer argument)\n");
        }
    }
}
