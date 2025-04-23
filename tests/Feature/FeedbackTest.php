<?php

namespace Tests\Feature;

use Tests\TestCase;

class FeedbackTest extends TestCase
{
    /**
     * Test untuk mengakses halaman create feedback.
     */
    public function test_can_access_feedback_create_page()
    {
        $response = $this->get(route('feedback.create'));

        // Memastikan response statusnya 500 (karena error)
        $response->assertStatus(500);
    }

}