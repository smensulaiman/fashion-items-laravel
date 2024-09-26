<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Contracts\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $sliders = Slider::where('status', 1)
            ->orderBy('serial')
            ->get();

        return view('frontend.home.home', compact('sliders'));
    }
}
