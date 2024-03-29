<?php

namespace Scholar;

class Command
{
    use InputCommand;
    protected $params = "";

    protected function params()
    {
        return array_slice($this->arguments(), 2);
    }

    protected function param($param)
    {
        if ($this->params == "") {
            return null;
        }
        $splitedParams = explode(" ", $this->params);
        $params = $this->params();
        if(empty($params)) return null;
        foreach($splitedParams as $key => $value) {
            if (str_replace(['{', '}'], '', $value) === $param) {
                return $params[$key];
                break;
            }
        }
        return null;
    }
}
