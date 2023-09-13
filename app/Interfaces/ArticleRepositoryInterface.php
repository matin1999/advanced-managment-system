<?php

namespace App\Interfaces;

use App\Models\Article;
use Illuminate\Support\Collection;

interface ArticleRepositoryInterface
{
    public function createArticle(array $data, int $user_id): ?Article;

    public function getUserArticles(int $user_id): ?Collection;

    public function getArticlesByPagination(int $offset, int $limit = 20): ?Collection;

    public function getArticlesCount(int $user_id = null): int;

    public function getArticleById(int $id): ?Article;

    public function deleteArticle(Article $article): bool;
    public function updateArticle(Article $article,array $data): ?Article;
}
