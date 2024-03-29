<?php

namespace Scholar;

trait InputCommand
{
    /**
     * Get Arguments on command instance
     * @return array
     */
    protected function arguments()
    {
        return $_SERVER['argv'];
    }
}
