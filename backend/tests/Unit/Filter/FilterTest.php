<?php

namespace Tests\Unit\Filter;

use PHPUnit\Framework\TestCase;

class FilterTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test_filter_class_exist(): void
    {
        $this->assertTrue(class_exists("App\Filters\api\HostersFilter"));
    }
}
