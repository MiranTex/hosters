<?php

namespace Tests\Feature\Hoster;

use App\Models\Hoster;
use App\Repositories\HosterRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\LazyCollection;
use Mockery\MockInterface;
use Tests\TestCase;

class HosterTest extends TestCase
{
    
    public function test_end_point_exist(): void
    {
        $hosters = LazyCollection::make(function () {
            yield new Hoster('Dell PowerEdge R230', '16GBDDR3', '2x2TBSATA2', 'Amsterdam', '€ 59.00');
        });
    
        $this->mock(HosterRepository::class, function (MockInterface $mock) use ($hosters){
            $mock->shouldReceive('getHosters')->once()->andReturn($hosters);
        });
        
        $response = $this->get('api/v1/hosters');


        $response->assertStatus(200);
    }

    public function test_end_point_return_data(): void
    {
        $hosters = LazyCollection::make(function () {
            yield new Hoster('Dell PowerEdge R230', '16GBDDR3', '2x2TBSATA2', 'Amsterdam', '€ 59.00');
        });


        $this->mock(HosterRepository::class, function (MockInterface $mock) use ($hosters){
            $mock->shouldReceive('getHosters')->once()->andReturn($hosters);
        });

        $response = $this->get('api/v1/hosters');

        $response->assertJsonStructure([
            'data' => [
                '*' => [
                    'model',
                    'ram',
                    'location',
                    'storage',
                    'price',
                ],
            ],
        ]);
    }

}
