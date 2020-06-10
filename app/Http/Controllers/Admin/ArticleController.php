<?php

declare(strict_types = 1);

namespace App\Http\Controllers\Admin;

use App\Article;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ArticleStoreRequest;
use App\Http\Requests\Admin\ArticleUpdateRequest;
use App\Repositories\ArticleRepository;
use App\Repositories\UserRepository;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

/**
 * Class ArticleController
 * @package App\Http\Controllers\Admin
 */
class ArticleController extends Controller
{
    /**
     * @var ArticleRepository
     */
    private $articleRepository;
    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * ArticleController constructor.
     * @param ArticleRepository $articleRepository
     * @param UserRepository $userRepository
     */
    public function __construct(ArticleRepository $articleRepository, UserRepository $userRepository)
    {
        $this->articleRepository = $articleRepository;
        $this->userRepository = $userRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        $articles = Article::query()->paginate(null, ['id', 'title', 'slug', 'poster']);

        return view('admin.article.list', ['items' => $articles]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        $authors = $this->userRepository->listFormSelectElement();

        return view('admin.article.form', ['authors' => $authors]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ArticleStoreRequest $request
     * @return RedirectResponse
     */
    public function store(ArticleStoreRequest $request): RedirectResponse
    {
        try {
            $this->articleRepository->createNew($request->getData());

            return redirect()->route('admin.article.index')
                ->with('success', 'Article created.');
        } catch (Exception $exception) {
            return back()->with('danger', $exception->getMessage())
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param Article $article
     * @return View
     */
    public function show(Article $article): View
    {
        $article->load('author');

        return view('admin.article.show', ['item' => $article]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Article $article
     * @return View
     */
    public function edit(Article $article): View
    {
        $authors = $this->userRepository->listFormSelectElement();

        return view('admin.article.form', [
            'item' => $article,
            'authors' => $authors,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ArticleUpdateRequest $request
     * @param Article $article
     * @return RedirectResponse
     */
    public function update(ArticleUpdateRequest $request, Article $article): RedirectResponse
    {
        try {
            $article->update($request->getData());

            return redirect()->route('admin.article.index')
                ->with('success', 'Article updated.');
        } catch (Exception $exception) {
            return back()->with('danger', $exception->getMessage())
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Article $article
     * @return RedirectResponse
     */
    public function destroy(Article $article): RedirectResponse
    {
        try {
            $article->delete();

            return redirect()->route('admin.article.index')
                ->with('success', 'Article deleted.');
        } catch (Exception $exception) {
            return back()->with('danger', $exception->getMessage());
        }
    }
}