<?php

namespace App\Repositories;


use App\Interfaces\ArticleRepositoryInterface;
use App\Models\Article;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;

class ArticlesRepository implements ArticleRepositoryInterface
{

    public function CreateArticle(array $data,int $user_id): ?Article
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

    public function getUserArticles(string $user_id): ?Collection
    {
        try {
            return Article::query()->where('user_id',$user_id)->get();
        }catch (\Exception $exception)
        {
            Log::error('getUserArticles_in_article_repository_exception_'.$exception->getMessage());
            return null;
        }
    }

    public function getArticlesByPagination(string $user_id, int $from, int $per_page = 20): ?Collection
    {
        try {
            return Article::query()->where('user_id',$user_id)->get();
        }catch (\Exception $exception)
        {
            Log::error('getArticlesByPagination_in_article_repository_exception_'.$exception->getMessage());
            return null;
        }
    }

    public function getArticlesCount(string $user_id = null): int
    {
        try {
            return Article::query()->when($user_id,function ($query, $user_id){
                $query->where('user_id',$user_id);
            })->count();
        }catch (\Exception $exception)
        {
            Log::error('getArticlesByPagination_in_article_repository_exception_'.$exception->getMessage());
            return 0;
        }
    }
}
