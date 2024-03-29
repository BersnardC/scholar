<?php

namespace Scholar;

class Console
{
    use InputCommand;
    private static $commands = [];
    private static $args;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        self::$args = self::arguments();
    }

    /**
     * Run a new command
     * This method check if command exists in avalibale commands array and call the Class 
     * for execute instructions
     * @return void
     */
    public function run()
    {
        if (count(self::$args) < 2) {
            echo "Scholar message: No method to run\n";
            return;
        }
        $method = self::$args[1];
        $pos = self::match($method);
        if ($pos === false) {
            echo "Scholar error: Method $method not registered\n";
            return;
        }
        $data = self::$commands[$method];
        $class = "App\\Console\\Commands\\{$data['class']}";
        if (!class_exists($class)) {
            echo "Scholar error: class $class no exist\n";
            return;
        }
        $class = new $class();
        $class->handle(self::$args);
    }

    /**
     * Register a new command 
     * @param string $command Name of command
     * @param string $class Class to Call
     * @return void
     */
    public function register(string $command, string $class): void
    {
        self::$commands[$command] = ['class' => $class, "params" => ""];
    }

    private function match(string $command)
    {
        $pos = array_search($command, array_keys(self::$commands));
        return $pos;
    }
}
