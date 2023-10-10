<?php

namespace App\Services;

use App\Models\Feedback;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class FeedbackService extends Service
{
    /**
     * @return Collection
     */
    public function getList(): Collection
    {
        return Feedback::query()->orderBy('rating', 'DESC')->get();
    }

    /**
     * @param array $attributes
     * @return Model
     */
    public function create(array $attributes): Model
    {
        return Feedback::query()->create($attributes);
    }

    /**
     * @param Request $request
     * @return array
     */
    public function prepareData(Request $request): array
    {
        $data = $request->validated();

        if ($request->file('photo')) {
            $data['photo'] = $this->uploadMedia($request->file('photo'));
        }

        return $data;
    }
}
