<?php

namespace App\Http\Controllers;

use App\Http\Requests\Article\CraeteArticle;
use App\Interfaces\ArticleRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Gate;


class ArticlesController extends Controller
{

    private ArticleRepositoryInterface $articleRepository;

    public function __construct(ArticleRepositoryInterface $userRepository)
    {
        $this->articleRepository = $userRepository;
    }

    public function index(Request $request)
    {
        $limit = $request->input('from', 0);
        $offset = $request->input('get', 20);
        try {
            return Response::json([
                'message' => 'successes',
                'data' => $this->articleRepository->getArticlesByPagination($offset, $limit)
            ]);
        } catch (\Exception $exception) {
            Log::error('ArticleController_index_exception_' . $exception->getMessage());
            return
                Response::json([
                    'message' => 'failed',
                    'data' => []
                ], 500);
        }


    }

    public function userArticles(int $user_id)
    {

        try {
            return Response::json([
                'message' => 'successes',
                'data' => $this->articleRepository->getUserArticles($user_id)
            ]);
        } catch (\Exception $exception) {
            Log::error('ArticleController_userArticles_exception_' . $exception->getMessage());
            return
                Response::json([
                    'message' => 'failed',
                    'data' => []
                ], 500);
        }
    }

    public function createArticle(CraeteArticle $request)
    {
        try {
            # TODO remove $request->all()
            $article = $this->articleRepository->CreateArticle($request->all(), Auth::id());
            return Response::json([
                'message' => $article ? 'successes' : 'failed',
                'data' => $article
            ], $article ? 200 : 500);
        } catch (\Exception $exception) {
            Log::error('ArticleController_createArticle_exception_' . $exception->getMessage());
            return Response::json([
                'message' => 'failed',
                'data' => null
            ], 500);
        }
    }

    public function deleteArticle(int $id)
    {

        $article = $this->articleRepository->getArticleById($id);
        if (!$this->authorize('canModifyArticle', $article) || Gate::allows('isAdmin')) {
            $deleted = $this->articleRepository->deleteArticle($article);
            return Response::json([
                'message' => $deleted ? 'successes' : 'failed',
            ], $deleted ? 200 : 500);

        } else {
            return Response::json([
                'message' => 'access-denied',
            ], 403);
        }
    }

    public function updateArticle(int $id)
    {
        $article = $this->articleRepository->getArticleById($id);
        if (!$this->authorize('canModifyArticle', $article) || Gate::allows('isAdmin')) {
            $updated_article = $this->articleRepository->deleteArticle($article);
            return Response::json([
                'message' => $updated_article ? 'successes' : 'failed',
                'data' => $updated_article
            ], $updated_article ? 200 : 500);

        } else {
            return Response::json([
                'message' => 'access-denied',
            ], 403);
        }

    }

}
