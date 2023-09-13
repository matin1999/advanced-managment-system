<?php

namespace App\Policies;

use App\Models\Article;
use App\Models\User;

class ArticlePolicy
{
    public function canModifyArticle(User $user, Article $article): bool
    {
        return $user->id == $article->user_id;
    }
}
