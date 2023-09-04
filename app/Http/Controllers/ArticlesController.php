<?php

namespace App\Http\Controllers;

use App\Interfaces\ArticleRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ArticlesController extends Controller
{

    private ArticleRepositoryInterface $articleRepository;

    public function __construct(ArticleRepositoryInterface $userRepository)
    {
        $this->articleRepository = $userRepository;
    }

    public function index()
    {
        return view('auth.dashboard');
    }

    public function userArticles(int $user_id)
    {
        $articles = $this->articleRepository->getUserArticles($user_id);
        return view('')->with($articles);
    }

    public function createArticle(Request $request)
    {

    }

    public function deleteArticle(Request $request)
    {

    }

    public function updateArticle(Request $request)
    {

    }
}
