<?php

use Scholar\Console;

$console = new Console();
/* Register commands */
$console->register('search', 'Search');
$console->register('admin', 'Admin');
$console->run();
