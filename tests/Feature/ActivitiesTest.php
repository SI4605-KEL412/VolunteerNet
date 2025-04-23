<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ActivitiesTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_activities_page_loads(): void
    {
        $response = $this->withoutMiddleware()->get('/activities');

        $response->assertStatus(200);
    }
}
