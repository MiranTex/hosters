<?php

namespace App\Http\Controllers\api\v1;

use App\Filters\api\HostersFilter;
use App\Http\Controllers\Controller;
use App\Repositories\HosterRepository;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;

class HostersController extends Controller
{
    //

    public function index(Request $request, HosterRepository $productRepository, HostersFilter $hostersFilter){

        $request = $request->capture();
        $queryParam = $request->query();

        $hosters = $productRepository->getHosters();

        $perPage = $queryParam['perPage'] ?? 10; 


        $hostersFiltred = $hostersFilter
            ->transform($request)
            ->filter($hosters);

        // dd($hostersFiltred->forPage(Paginator::resolveCurrentPage(), $perPage),);
        
        //make pagination
        $paginatedItems = new LengthAwarePaginator(
            $hostersFiltred->forPage(Paginator::resolveCurrentPage(), $perPage),
            $hostersFiltred->count(),
            $perPage,
            null,
            ['path' => Paginator::resolveCurrentPath(),'query' => $queryParam]
        );

        sleep(5);

        return $paginatedItems;

    }
}
