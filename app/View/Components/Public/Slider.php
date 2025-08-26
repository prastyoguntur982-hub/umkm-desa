<?php

namespace App\View\Components\Public;

use Illuminate\View\Component;
use App\Models\Slider as SliderModel;

class Slider extends Component
{
    public $sliders;

    public function __construct()
    {
        $this->sliders = SliderModel::all();
    }

    public function render()
    {
        return view('components.public.slider', [
            'sliders' => $this->sliders,
        ]);
    }
}
