<?php

declare(strict_types = 1);

namespace App\Http\Controllers\Account;

use App\Article;
use App\Http\Controllers\Controller;
use App\Http\Requests\Front\Account\ArticleStoreRequest;
use App\Http\Requests\Front\Account\ArticleUpdateRequest;
use App\Repositories\ArticleRepository;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

/**
 * Class ArticleController
 * @package App\Http\Controllers\Account
 */
class ArticleController extends Controller
{
    /**
     * @var ArticleRepository
     */
    private $articleRepository;

    /**
     * ArticleController constructor.
     * @param ArticleRepository $articleRepository
     */
    public function __construct(ArticleRepository $articleRepository)
    {
        $this->articleRepository = $articleRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        $accountId = auth()->user()->getAuthIdentifier();
        $articles = $this->articleRepository->getPaginateByAccountId($accountId);

        return view('front.account.article.list', ['items' => $articles]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        return view('front.account.article.form');
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

            return redirect()->route('account.article.index')
                ->with('success', 'Article created.');
        } catch (Exception $exception) {
            logger()->error($exception->getMessage(), $exception->getTrace());

            return back()->with('danger', 'Something wrong, please try again later.')
                ->withInput();
        }
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param Article $article
     * @return View
     */
    public function edit(Article $article): View
    {
        return view('front.account.article.form', ['item' => $article]);
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

            if ($article->wasChanged()) {
                $this->articleRepository->changeActive($article->id, false);
            }

            return redirect()->route('account.article.index')
                ->with('success', 'Article updated.');
        } catch (Exception $exception) {
            logger()->error($exception->getMessage(), $exception->getTrace());

            return back()->with('danger', 'Something wrong, please try again later.')
                ->withInput();
        }
    }
}