<?php

declare(strict_types = 1);

namespace App\Http\Controllers;

use App\Http\Requests\Front\CommentStoreRequest;
use App\Repositories\ArticleCommentRepository;
use Illuminate\Http\JsonResponse;

/**
 * Class CommentController
 * @package App\Http\Controllers
 */
class CommentController extends Controller
{
    /**
     * @var ArticleCommentRepository
     */
    private $commentRepository;

    /**
     * CommentController constructor.
     * @param ArticleCommentRepository $commentRepository
     */
    public function __construct(ArticleCommentRepository $commentRepository)
    {
        $this->commentRepository = $commentRepository;
    }

    /**
     * @param CommentStoreRequest $request
     * @return JsonResponse
     */
    public function store(CommentStoreRequest $request): JsonResponse
    {
        $comment = $this->commentRepository->createNew($request->getData());

        return response()->json([
            'message' => 'Thank you for your comment',
            'comment' => $comment,
        ]);
    }
}