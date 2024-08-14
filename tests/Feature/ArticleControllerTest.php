<?php

namespace Tests\Feature;

use App\Models\Article;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ArticleControllerTest extends TestCase
{
    use RefreshDatabase;

    protected $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
    }

    public function test_index_displays_articles()
    {
        $articles = Article::factory()->count(3)->create();

        $response = $this->actingAs($this->user)->get(route('articles.index'));

        $response->assertStatus(200);
        $response->assertViewIs('articles.index');
        $response->assertViewHas('articles');
    }

    public function test_create_displays_form()
    {
        $response = $this->actingAs($this->user)->get(route('articles.create'));

        $response->assertStatus(200);
        $response->assertViewIs('articles.create');
    }

    public function test_store_creates_new_article()
    {
        $articleData = [
            'name' => 'Test Article',
            'description' => 'This is a test article',
            'quantity' => 10,
            'price' => 19.99,
            'user_id' => $this->user->id,
        ];

        $response = $this->actingAs($this->user)->post(route('articles.store'), $articleData);

        $response->assertRedirect(route('articles.index'));
        $this->assertDatabaseHas('articles', $articleData);
    }

    public function test_show_displays_article()
    {
        $article = Article::factory()->create();

        $response = $this->actingAs($this->user)->get(route('articles.show', $article));

        $response->assertStatus(200);
        $response->assertViewIs('articles.show');
        $response->assertViewHas('article');
    }

    public function test_edit_displays_form()
    {
        $article = Article::factory()->create();

        $response = $this->actingAs($this->user)->get(route('articles.edit', $article));

        $response->assertStatus(200);
        $response->assertViewIs('articles.edit');
        $response->assertViewHas('article');
    }

    public function test_update_changes_article()
    {
        $article = Article::factory()->create();
        $updatedData = [
            'name' => 'Updated Article',
            'description' => 'This is an updated article',
            'quantity' => 5,
            'price' => 29.99,
            'user_id' => $this->user->id,
        ];

        $response = $this->actingAs($this->user)->put(route('articles.update', $article), $updatedData);

        $response->assertRedirect(route('articles.index'));
        $this->assertDatabaseHas('articles', $updatedData);
    }

    public function test_destroy_deletes_article()
    {
        $article = Article::factory()->create();

        $response = $this->actingAs($this->user)->delete(route('articles.destroy', $article));

        $response->assertRedirect(route('articles.index'));
        $this->assertDatabaseMissing('articles', ['id' => $article->id]);
    }
}
