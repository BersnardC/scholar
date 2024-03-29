<?php

namespace Scholar;

class Command
{
    use InputCommand;
    protected $params = "";

    /**
     * Get params in command
     * Example: php main.php search param1 param2 ... paramn
     * @return array
     */
    protected function params()
    {
        return array_slice($this->arguments(), 2);
    }

    /**
     * Get value for a param
     * @param string $params Name of params
     * @return void
     */
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
