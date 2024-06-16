<?php

namespace Tests\Feature\Hoster;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class HosterTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_end_point_exist(): void
    {
        $response = $this->get('api/v1/hosters');

        $response->assertStatus(200);
    }

    public function test_end_point_return_data(): void
    {
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

    // public function test_end_point_return_data_with_filters(): void
    // {
    //     $perPage = 1000;

    //     $response = $this->get('api/v1/hosters?ram_type[in]=DDR3&hddType[eq]=SATA2&location[like]=Amsterdam&storage_capacity[lt]=500&perPage=' . $perPage);
    //     $response_without_filter = $this->get('api/v1/hosters?perPage=5'); 

    //     //assert that the response with filters is less than the response without filters
    //     $this->assertLessThan(count($response_without_filter->json('data')), count($response->json('data')));

    //     $response->assertJsonStructure([
    //         'data' => [
    //             '*' => [
    //                 'model',
    //                 'ram',
    //                 'location',
    //                 'hdd',
    //                 'price',
    //             ],
    //         ],
    //     ]);
    // }
}
