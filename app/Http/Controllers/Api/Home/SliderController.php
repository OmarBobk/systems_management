<?php

namespace App\Http\Controllers\Api\Home;

use App\Http\Controllers\Controller;
use App\Http\Resources\SliderResource;
use App\Models\Slider;
use App\Traits\JsonRespondController;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    use JsonRespondController;

    /**
     * Handle the incoming request.
     */
    public function __invoke()
    {
        try {
            $data = Slider::with([
                'background',
                'slidercontents' => function ($q) {
                    $q->orderBy('order');
                },
                'slidercontents.small_image',
                'slidercontents.big_image'
                ])
                ->whereStatus(1)
                ->orderBy('order')->get();

        } catch (\Throwable $throwable) {
            return $this->respondInvalidQuery([
                'status' => false,
                'message' => $throwable->getMessage()
            ]);
        }

        return $this->respond(SliderResource::collection($data));
    }
}
