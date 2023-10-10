<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Feedback\CreateFeedbackRequest;
use App\Http\Resources\Feedback\FeedbackCollection;
use App\Http\Resources\Feedback\FeedbackResource;
use App\Services\FeedbackService;

class FeedbackController extends Controller
{
    public function __construct(public FeedbackService $feedbackService)
    {
    }

    /**
     * @return FeedbackCollection
     */
    public function index(): FeedbackCollection
    {
        $data = $this->feedbackService->getList();
        return new FeedbackCollection($data);
    }

    /**
     * @param CreateFeedbackRequest $request
     * @return FeedbackResource
     */
    public function store(CreateFeedbackRequest $request): FeedbackResource
    {
        $attributes = $this->feedbackService->prepareData($request);
        $feedback = $this->feedbackService->create($attributes);

        return new FeedbackResource($feedback);
    }
}
