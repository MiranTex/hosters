<?php

namespace App\Repositories;

use App\Models\Hoster;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\LazyCollection;

class HosterRepository
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }


    public function getHosters(): LazyCollection
    {
        $file = Storage::get('LeaseWeb_servers_filters_assignment.csv');

        $csv = array_map('str_getcsv', explode("\n", $file));

        //remove the first row
        array_shift($csv);

        // $hosters = new Collection();

        $hosters = LazyCollection::make(function () use ($csv) {
            foreach ($csv as $row) {
                yield new Hoster(
                    $row[0], 
                    $row[1], 
                    $row[2], 
                    $row[3], 
                    $row[4]
                );
            }
        });


        return $hosters;
    }

    
}
