<?php

namespace Scholar;

trait InputCommand
{
    protected function arguments()
    {
        return $_SERVER['argv'];
    }
}
