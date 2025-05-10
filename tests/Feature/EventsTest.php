<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EventsTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/events');

        $response->assertStatus(200);
    }

    public function setUp(): void
{
    parent::setUp();
    $this->artisan('migrate:fresh'); // atau 'migrate'
}
}
