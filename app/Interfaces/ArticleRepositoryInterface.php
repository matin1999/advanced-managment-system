<?php

namespace App\Interfaces;

use App\Models\Article;
use Illuminate\Support\Collection;

interface ArticleRepositoryInterface
{
    public function CreateArticle(array $data,int $user_id) : ?Article;
    public function getUserArticles(string $user_id): ?Collection;
    public function getArticlesByPagination(string $user_id,int $from,int $per_page = 20): ?Collection;
    public function getArticlesCount(string $user_id = null): int;
}
