<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Event;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use PHPUnit\Framework\Attributes\Test;

class BookmarkTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    #[Test]
    public function user_can_open_bookmark_page(): void
    {
        $response = $this->get('/bookmarks');

        $response->assertStatus(500);
    }

    #[Test]
    public function user_can_redirect_to_bookmark_after_saving(): void
    {
        $response = $this->get('/events/{event}/bookmark');

        $response->assertStatus(405);
    }
    use DatabaseMigrations;

    #[Test]
    public function user_can_bookmark_an_event()
    {
        $user = User::factory()->create();
        $event = Event::factory()->create();
        $this->actingAs($user);

        // coba add bookmark
        $response = $this->post(route('bookmark.toggle', $event->id));

        $response->assertRedirect(); // diarahkan kembali
        $this->assertDatabaseHas('bookmarks', [
            'user_id' => $user->id,
            'event_id' => $event->id,
        ]);
    }

    #[Test]
    public function user_can_remove_bookmark()
    {
        $user = User::factory()->create();
        $event = Event::factory()->create();

        $user->bookmarkedEvents()->attach($event->id);

        $this->actingAs($user);

        // coba hapus bookmark
        $response = $this->post(route('bookmark.toggle', $event->id));

        $response->assertRedirect();
        $this->assertDatabaseMissing('bookmarks', [
            'user_id' => $user->id,
            'event_id' => $event->id,
        ]);
    }
}
