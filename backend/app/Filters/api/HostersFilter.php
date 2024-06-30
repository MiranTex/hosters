<?php

namespace App\Filters\api;

use Illuminate\Support\Collection;
use Illuminate\Support\LazyCollection;

class HostersFilter extends ApiBaseFilter
{
    
    protected $safeParams = [
        "ramType" => ["eq",'in'],
        "ramCapacity" => ["in"],
        "diskType" => ["eq"],
        "location" => ["eq"],
        "storage" => ["gte","lte","gt","lt"]
    ];

    protected $columnMap = [
        "diskType" => "hdd_type",
        "storage" => "hdd_capacity",
        "ramType" => "ram_type",
        "ramCapacity" => "ram_capacity"
    ];


    public function filter(LazyCollection $hosters){

        $filters = $this->filters;

        foreach($filters as $filter){
            if($filter['operator'] == 'in'){
                $hosters = $hosters->whereIn($filter['column'], $filter['value']);
                continue;
            } 
            $hosters = $hosters->where($filter['column'], $filter['operator'], $filter['value']);
        }

        return $hosters;
        
    }
}
