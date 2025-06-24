<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Book;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BookFeatureTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_cannot_access_dashboard()
    {
        $response = $this->get('/dashboard');
        $response->assertRedirect('/login');
    }

    public function test_authenticated_user_can_access_dashboard()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/dashboard');
        $response->assertStatus(200);
        $response->assertSee($user->name);
    }

    public function test_user_can_see_their_books()
    {
        $user = User::factory()->create();
        Book::factory()->count(2)->create(['user_id' => $user->id]);
        Book::factory()->count(1)->create(); // buku milik user lain

        $response = $this->actingAs($user)->get('/books');
        $response->assertStatus(200);
        $response->assertSeeTextInOrder([$user->books[0]->title, $user->books[1]->title]);
    }
}
