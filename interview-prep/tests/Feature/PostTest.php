<?php

use App\Models\User;
use App\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PostTest extends TestCase
{
    use RefreshDatabase;

    public function test_authenticated_user_can_create_post()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->post('/posts', [
            'title' => 'New Post Title',
            'content' => 'Content of the new post',
        ]);

        $response->assertRedirect('/posts');
        $this->assertDatabaseHas('posts', ['title' => 'New Post Title']);
    }

    public function test_guest_cannot_create_post()
    {
        $response = $this->post('/posts', [
            'title' => 'Unauthorized Post',
            'content' => 'Should not be created',
        ]);

        $response->assertRedirect('/login');
    }

    public function test_user_can_view_all_posts()
    {
        $user = User::factory()->create(); // Create a user
        $this->actingAs($user); // Authenticate the user

        Post::factory()->count(3)->create();
        $response = $this->get('/posts');

        $response->assertStatus(200);
        $response->assertViewIs('posts.index');
        $response->assertSeeText('Posts');
    }
}
