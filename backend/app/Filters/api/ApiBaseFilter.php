<?php

namespace App\Filters\api;

use Illuminate\Http\Request;

class ApiBaseFilter
{
    protected $safeParams = [];

    protected $filters = []; 

    protected $columnMap = [];

    protected $operatorMap = [
        "eq" => "=",
        "neq" => "!=",
        "gt" => ">",
        "gte" => ">=",
        "lt" => "<",
        "lte" => "<=",
        "like" => "like",
        "in" => "in",
        "nin" => "not in",
        "btw" => "between"
    ];
    

    public function transform(Request $request){

        $eloQuery = [];


        foreach($this->safeParams as $param => $operators){
            
            
            $query = $request->query($param);
            
            if(!isset($query)){
                continue;
            }
            
            $column = $this->columnMap[$param] ?? $param;


            foreach($operators as $operator){


                if(isset($query[$operator])){

                    $val = $query[$operator];
                    $val = explode(",",$val);

                    if(count($val) == 1){
                        $val = $val[0];

                        if(is_numeric($val)){
                            $val = (int)$val;
                        }
                    }

                    $eloQuery[] = [
                        "column" => $column,
                        "operator" => $this->operatorMap[$operator],
                        "value" => $operator == "like" ? "%".$val."%" : $val
                    ];
                }
            }

        }
        $this->filters = $eloQuery;
        return $this;
    }
}
