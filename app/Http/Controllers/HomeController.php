<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Repositories\ArticleRepository;

class HomeController extends Controller
{
/**
     * @var ArticleRepository
     */
    private $articleRepository;

    /**
     * HomeController constructor.
     * @param ArticleRepository $articleRepository
     */
    public function __construct(ArticleRepository $articleRepository)
    {
        $this->articleRepository = $articleRepository;
    }

    public function __invoke(): View
    {
        $articles = $this->articleRepository->getActivePaginate();

        return view('front.welcome', ['articles' => $articles]);}
}
