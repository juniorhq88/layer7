<?php

namespace Tests\Unit\Repositories;

use App\Models\Article;
use App\Models\User;
use App\Repositories\ArticleRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ArticleRepositoryTest extends TestCase
{
    use RefreshDatabase;

    protected $articleRepository;

    protected function setUp(): void
    {
        parent::setUp();
        $this->articleRepository = new ArticleRepository;
    }

    public function test_it_can_retrieve_all_articles()
    {
        Article::factory()->count(5)->create();
        $articles = $this->articleRepository->all();
        $this->assertCount(5, $articles);
    }

    public function test_it_can_find_a_article_by_id()
    {
        $article = Article::factory()->create();
        $foundarticle = $this->articleRepository->find($article->id);
        $this->assertEquals($article->id, $foundarticle->id);
    }

    public function test_it_can_create_a_article()
    {
        $data = [
            'name' => 'Super Fruits',
            'description' => 'my description',
            'quantity' => 1,
            'price' => 100,
            'user_id' => User::factory()->create()->id,
        ];

        $article = $this->articleRepository->create($data);
        $this->assertEquals(100, $article->price);
        $this->assertDatabaseHas('articles', ['price' => 100]);
    }

    public function test_it_can_update_a_article()
    {
        $article = Article::factory()->create();
        $data = ['name' => 'Super Fruits'];

        $updatedarticle = $this->articleRepository->update($article->id, $data);

        $this->assertTrue($updatedarticle);

        $this->assertDatabaseHas('articles', ['id' => $article->id, 'name' => 'Super Fruits']);
    }

    public function test_it_can_delete_a_article()
    {
        $article = Article::factory()->create();

        $this->articleRepository->delete($article->id);
        $this->assertDatabaseMissing('articles', ['id' => $article->id]);
    }
}
