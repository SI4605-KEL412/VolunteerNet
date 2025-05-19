<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DashboardTest extends TestCase
{
    /** @test */
    public function dashboard_page_returns_success_status()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
