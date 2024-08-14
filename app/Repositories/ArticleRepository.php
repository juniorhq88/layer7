<?php

namespace App\Repositories;

use App\Models\Article;
use Illuminate\Database\Eloquent\Collection;

class ArticleRepository implements RepositoryInterface
{
    /**
     * Get all Articles.
     *
     * @return Collection<int, Article>
     */
    public function all(): Collection
    {
        return Article::all();
    }

    /**
     * Find a Article by ID.
     */
    public function find(int $id): ?Article
    {
        return Article::find($id);
    }

    /**
     * Get a Article by email.
     */
    public function getArticleByEmail(string $email): ?Article
    {
        return Article::whereEmail($email)->first();
    }

    /**
     * Create a new Article.
     *
     * @param  array<string, mixed>  $data
     */
    public function create(array $data): Article
    {
        return Article::create($data);
    }

    /**
     * Update a Article.
     *
     * @param  array<string, mixed>  $data
     */
    public function update(int $id, array $data): bool
    {
        $article = $this->find($id);
        if ($article) {
            return $article->update($data);
        }

        return false;
    }

    /**
     * Delete a article.
     */
    public function delete(int $id): ?bool
    {
        $article = $this->find($id);
        if ($article) {
            return $article->delete();
        }

        return false;
    }
}
