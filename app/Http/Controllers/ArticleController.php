<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreArticleRequest;
use App\Http\Resources\ArticleCollection;
use App\Http\Resources\ArticleResource;
use App\Models\Article;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * ArticleController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth:api')->except('index', 'show');
    }


    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $articles = Article::paginate();
        return response()->json(new ArticleCollection($articles));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreArticleRequest $request
     * @return JsonResponse
     */
    public function store(StoreArticleRequest $request): JsonResponse
    {
        Article::create([
            'user_id' => 1,
            'title' => $request->title,
            'description' => $request->description,
            'image' => $this->uploadFile($request)
        ]);

        return \response()->json([
            'message' => 'created'
        ], 201);
    }

    private function uploadFile(Request $request)
    {
        return $request->hasFile('image')
            ? $request->image->store('public')
            : null;
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        $article = Article::findOrFail($id);
        return response()->json([
            'data' => new ArticleResource($article)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(Request $request, $id): JsonResponse
    {
        $article = Article::findOrFail($id);
        $article->update($request->all());
        return \response()->json([
            'message' => 'updated'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Article $article
     * @return JsonResponse
     */
    public function destroy(Article $article): JsonResponse
    {
        $article->delete();
        return \response()->json([
            'message' => 'deleted'
        ]);
    }
}
