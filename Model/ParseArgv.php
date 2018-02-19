<?php

class ParseArgv
{
    private $argsParsed;
    private $argsUnparsed;

    public function __construct($args)
    {
        $this->argsUnparsed = $args;

        $this->argsParsed = array(
            "One" => "one",
            "Two" => "two"
        );

        $this->checkFlags($args);
    }

    private function checkFlags($args)
    {
        $flag_check = "/^-[0-9a-fA-F]$/";

        for ($i = 0; $i < count($args); $i++) {
            if(preg_match($flag_check, $args[$i]))
            {
                print("FLAG FOUND");
            }
        }


    }

    public function getParsed()
    {
        //return $this->argsParsed;

        return $this->argsUnparsed;
    }
}
