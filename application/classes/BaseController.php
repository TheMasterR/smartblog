<?php

class BaseController
{
    protected $params,$output;

    public function __construct($params=array())
    {
        $this->params = $params;
        $this->output = array();
    }

    // declare function
    public function getOutput()
    {
        return $this->output;
    }

}