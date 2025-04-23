<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HomePageFeedbackTest extends TestCase
{
    /** @test */
    public function homepage_displays_feedback_form()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('Submit Your Feedback');
    }
}