<?php

namespace App\Repositories;


use App\Interfaces\ArticleRepositoryInterface;
use App\Models\Article;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;

class ArticlesRepository implements ArticleRepositoryInterface
{

    public function createArticle(array $data, int $user_id): ?Article
    {
        $article = new Article();
        $article->title = $data['title'];
        $article->content = $data['content'];
        $article->status_id = $data['status_id'];
        try {
            $article->save();
            return $article;
        } catch (\Exception $exception) {
            Log::error('CreateArticle_to_db_exception_' . $exception->getMessage());
            return null;
        }
    }

    public function getUserArticles(int $user_id): ?Collection
    {
        try {
            return Article::query()->where('user_id', $user_id)->get();
        } catch (\Exception $exception) {
            Log::error('getUserArticles_in_article_repository_exception_' . $exception->getMessage());
            return null;
        }
    }

    public function getArticlesByPagination(int $offset, int $limit = 20): ?Collection
    {
        try {
            return Article::query()->offset($offset)->limit($limit)->get();
        } catch (\Exception $exception) {
            Log::error('getArticlesByPagination_in_article_repository_exception_' . $exception->getMessage());
            return null;
        }
    }

    public function getArticlesCount(int $user_id = null): int
    {
        try {
            return Article::query()->when($user_id, function ($query, $user_id) {
                $query->where('user_id', $user_id);
            })->count();
        } catch (\Exception $exception) {
            Log::error('getArticlesByPagination_in_article_repository_exception_' . $exception->getMessage());
            return 0;
        }
    }

    public function getArticleById(int $id): ?Article
    {
        try {
            return Article::query()->where('id', $id)->first();
        } catch (\Exception $exception) {
            Log::error('getArticleById_in_article_repository_exception_' . $exception->getMessage());
            return null;
        }
    }

    public function deleteArticle(Article $article): bool
    {
        try {
            $article->delete();
            return true;
        } catch (\Exception $exception) {
            Log::error('deleteArticle_in_article_repository_exception_' . $exception->getMessage());
            return false;
        }
    }

    public function updateArticle(Article $article,array $data): ?Article
    {
        $article->title = $data['title'];
        $article->content = $data['content'];
        $article->status_id = $data['status_id'];
        try {
            $article->save();
            return $article;
        } catch (\Exception $exception) {
            Log::error('updateArticle_to_db_exception_' . $exception->getMessage());
            return null;
        }
    }
}
