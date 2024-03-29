<?php

namespace App\Console\Commands;

use Scholar\Command;
use App\Models\Search as SearchModel;

class Search extends Command
{
    protected $params = "{to_search}";
    public function handle()
    {
        $val = $this->param('to_search');
        if (!$val) {
            echo "Error: ingrese filtro de búsqueda\n";
            return false;
        }
        SearchModel::start($val);
    }
}
