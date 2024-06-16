<?php

namespace App\Filters\api;

use Illuminate\Support\Collection;

class HostersFilter extends ApiBaseFilter
{
    
    protected $safeParams = [
        "ram_type" => ["eq",'in'],
        "hddType" => ["eq"],
        "location" => ["eq"],
        "storage_capacity" => ["gte","lte","gt","lt"]
    ];

    protected $columnMap = [
        "hddType" => "hdd_type",
        "storage_capacity" => "hdd_capacity"
    ];


    public function filter(Collection $hosters){

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
