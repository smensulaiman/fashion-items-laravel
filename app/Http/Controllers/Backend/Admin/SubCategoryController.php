<?php

namespace App\Http\Controllers\Backend\Admin;

use App\DataTables\SubCategoryDataTable;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(SubCategoryDataTable $dataTable)
    {
        return $dataTable->render('admin.sub-category.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $categories = Category::all();
        return view('admin.sub-category.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //dd($request->all());

        $request->validate([
            'category' => ['required'],
            'name' => ['required', 'string', 'max:200', 'unique:sub_categories,name'],
            'status' => ['required'],
        ]);

        $subCategory = new SubCategory();
        $subCategory->category_id = $request->input('category');
        $subCategory->name = $request->input('name');
        $subCategory->slug = Str::slug($request->input('name'));
        $subCategory->status = $request->input('status');

        try {
            $subCategory->save();
        }catch (Exception $exception){
            toastr()->error($exception->getMessage());
        }

        toastr()->success('Sub-Category created successfully!', array(), 'success');
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
        $categories = Category::where('status', 1)->get();
        $subCategory = SubCategory::findOrFail($id);

        //dd($subCategory);
        return view('admin.sub-category.edit', compact('categories', 'subCategory'));
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
