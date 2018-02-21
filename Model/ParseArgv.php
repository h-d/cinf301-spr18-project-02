<?php

class ParseArgv
{

    //create argsParsed array
    private $flagsParsed = array();
    private $singlesParsed = array();
    private $doublesParsed = array();

    //construct function runs parse for given args
    public function __construct($args)
    {
        $this->parse($args);
    }

    //parses arg into manageable array
    private function parse($args)
    {
        //strings for checking -(char) and --(string)=(string)
        $single_check = "/^-[0-9a-zA-Z]$/";
        $double_check = "/^--(.*?)\=(.*?)/";

        //loop through arg array
        for ($i = 0; $i < count($args); $i++) {

            //checks if arg is a single (i.e. -f)
            if (preg_match($single_check, $args[$i])) {

               //is arg the final arg?
               if ($i + 1 >= count($args)) {
                    $this->flagsParsed[] = $args[$i];


                //is the arg followed by an arg beginning with "-"?
                } else if (preg_match("/^-/", $args[$i + 1])) {
                    $this->flagsParsed[] = $args[$i];



                //if not, create add a single to the singlesParsed array using the breakup_single function
                } else {
                    $this->breakup_single($args, $i, $args[$i + 1]);
                }


            //check if arg matches double_check
            } else if (preg_match($double_check, $args[$i]))
            {
                $this->breakup_double($args[$i]);
            }
        }

    }


    //function to break up string following single into vals
    private function breakup_single($args, $i, $string)
    {
        //create list from comma-delimited string
        $vals = explode(',', $string);

        //add vals from list into singlesParsed array at the given index
        for($n = 0; $n < count($vals);$n++)
        {
            $this->singlesParsed[$args[$i]][] = $vals[$n];
        }
    }

    //function to break up double string
    private function breakup_double($string)
    {
        //break into name and values
        list($name, $value) = explode('=', $string);

        //break values into a list of vals
        $vals = explode(',', $value);

        //add all vals to the doubleParsed array in the name index
        for($n = 0; $n < count($vals);$n++)
        {
            $this->doublesParsed[$name][] = $vals[$n];
        }
    }

    //return all arrays in one mega-array
    public function getParsed()
    {

        $parsedArgs = array();
        $parsedArgs['FLAGS'] = $this->flagsParsed;
        $parsedArgs['SINGLES'] = $this->singlesParsed;
        $parsedArgs['DOUBLES'] = $this->doublesParsed;

        return $parsedArgs;
    }


    //print the mega-array
    public function print_Parsed($parsedArgs)
    {
        foreach ($parsedArgs as $category=>$type) {
            print("\n$category\n");

            //if category is flags, only print the flag values
            if ($category == 'FLAGS') {
                foreach ($type as $name => $value) {
                    //replace dashes with '' and print
                    $tempval = preg_replace('/\-/', "", $value);
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
    }


}
