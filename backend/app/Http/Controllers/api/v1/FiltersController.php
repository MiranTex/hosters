<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Models\Hoster;
use App\Repositories\HosterRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class FiltersController extends Controller
{
    //
    function index(HosterRepository $hosterRepository){

        return Cache::remember('filters', 60*60*24, function() use ($hosterRepository){
        

            $hosters = $hosterRepository->getHosters();
        
            $locations = collect([]);
            $ram = collect(['type'=>collect([]), 'capacity'=>collect([])]);
            $hddTypes = collect([]);
            $storages = collect([]);
        
            $hosters->each(function(Hoster $hoster) use (&$locations, &$ram, &$hddTypes, &$storages){
        
                //locations
                if(!$locations->contains($hoster->getLocation())){
                    $locations->push($hoster->getLocation());
                }
        
                //ram
                $ramValue = $hoster->getRamValue();

                if(!$ram['type']->contains($ramValue['type'])){
                    $ram['type']->push($ramValue['type']);
                }

                if(!$ram['capacity']->contains($ramValue['capacity'])){
                    $ram['capacity']->push(intval($ramValue['capacity']));
                }

        
        
                //hdd 
                $hddValue = $hoster->getHDDValue();
                if(!$hddTypes->contains($hddValue['type'])){
                    $hddTypes->push($hddValue['type']);
                }
        
        
                //storage
                if($storages->has($hddValue['unity'])){
                    if(!$storages[$hddValue['unity']]->contains($hddValue['capacity'])){
                        $storages[$hddValue['unity']]->add($hddValue['capacity']);  
                    }
                }else{
                    $storages[$hddValue['unity']] = collect([$hddValue['capacity']]);
                }
                
            });
        
            //sort ram capacity
            $ram['capacity'] = $ram['capacity']->sort()->values();
            

            //adjust storages
            $storages = $storages->map(function(Collection $item, $key){
                return $item->map(function($item) use ($key){
        
        
                    return [
                        'label' => ($key == "TB" ? $item / 1024 : $item).$key,
                        'value' => $item,
                        'unity' => $key
                    ];
        
                })->sort(function($a, $b){
                    return $a['value'] <=> $b['value'];
                });
            });

            $storages = $storages->flatten(1)->sort(function($a, $b){
                return $a['value'] <=> $b['value'];
            })->values();
        
            return [
                'locations' => $locations->sort()->values(),
                'ram' => $ram,
                'hddTypes' => $hddTypes->sort()->values(),
                'storages' => $storages
            ];
        });
    }
}

