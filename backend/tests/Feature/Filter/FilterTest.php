<?php

namespace Tests\Feature\Filter;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class FilterTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_filter_end_point(): void
    {
        $response = $this->get('api/v1/filters');

        $response->assertStatus(200);
    }

    public function test_filter_end_point_return_data(): void
    {
        $response = $this->get('api/v1/filters');

        $response->assertJsonStructure([
            "locations",
            "ram",
            "hddTypes",
            "storages"
        ]);
    }
}
