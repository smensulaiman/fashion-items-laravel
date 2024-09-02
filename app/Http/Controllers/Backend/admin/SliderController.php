<?php

namespace App\Http\Controllers\Backend\admin;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use App\Traits\ImageUploadTrait;
use Exception;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SliderController extends Controller
{

    use ImageUploadTrait;

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('admin.slider.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.slider.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'banner' => ['required'],
            'type' => ['string', 'max:200'],
            'title' => ['required', 'max:200'],
            'starting_price' => ['required', 'numeric'],
            'url' => ['url'],
            'serial' => ['required', 'integer'],
            'status' => ['required', 'integer'],
        ]);

        $slider = new Slider();

        try {
            /** Handle file upload */

            $slider->banner = $this->uploadImage($request, 'banner', 'uploads');

            $slider->type = request('type');
            $slider->title = request('title');
            $slider->starting_price = request('starting_price');
            $slider->url = request('url');
            $slider->serial = request('serial');
            $slider->status = request('status');
            $slider->save();

        } catch (Exception $exception) {
            toastr()->error($exception->getMessage(), array(), 'failed');
        }

        toastr()->success('Slider created successfully!', array(), 'success');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
