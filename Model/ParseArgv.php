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
        //string for checking -(char)
        $single_check = "/^-[0-9a-fA-F]$/";


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
                } else {
                    $this->breakup_string($args, $i, $args[$i + 1]);
                }
            }
        }

    }

    private function breakup_string($args, $i, $string)
    {
        $this->singlesParsed[$args[$i]] = $string;
    }


    //return flag array
    public function getParsed()
    {

        $parsedArgs = array();
        $parsedArgs['FLAGS'] = $this->flagsParsed;
        $parsedArgs['SINGLES'] = $this->singlesParsed;
        $parsedArgs['DOUBLES'] = $this->doublesParsed;

        return $parsedArgs;
    }

}
