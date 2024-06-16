<?php

namespace App\Repositories;

use App\Models\Hoster;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Storage;

class HosterRepository
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }


    public function getHosters() : Collection
    {
        $file = Storage::get('LeaseWeb_servers_filters_assignment.csv');

        $csv = array_map('str_getcsv', explode("\n", $file));

        //remove the first row
        array_shift($csv);

        $hosters = new Collection();

        foreach ($csv as $row) {
           
            $hosters->push(new Hoster(
                $row[0], 
                $row[1], 
                $row[2], 
                $row[3], 
                $row[4]
            ));
        }

        return $hosters;
    }

    
}
