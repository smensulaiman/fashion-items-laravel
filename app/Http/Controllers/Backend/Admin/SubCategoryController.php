<?php

namespace App\Http\Controllers\Backend\Admin;

use App\DataTables\SubCategoryDataTable;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

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

        $this->validateSubCategory($request);

        $subCategory = new SubCategory();
        $subCategory->category_id = $request->input('category');
        $subCategory->name = $request->input('name');
        $subCategory->slug = Str::slug($request->input('name'));
        $subCategory->status = $request->input('status');

        try {
            $subCategory->save();
        } catch (Exception $exception) {
            toastr()->error($exception->getMessage());
        }

        toastr()->success('Sub Category created successfully!', array(), 'success');
        return redirect()->route('admin.sub-category.index')->with('success', 'Sub-Category created successfully!');

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
    public function edit(string $id): View
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
        $this->validateSubCategory($request, $id);

        $subCategory = SubCategory::findOrFail($id);
        $subCategory->category_id = $request->input('category');
        $subCategory->name = $request->input('name');
        $subCategory->slug = Str::slug($request->input('name'));
        $subCategory->status = $request->input('status');

        try {
            $subCategory->save();
        } catch (Exception $exception) {
            toastr()->error($exception->getMessage());
        }

        toastr()->success('Sub Category updated successfully!', array(), 'success');
        return redirect()->route('admin.sub-category.index')->with('success', 'Sub Category updated successfully!');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            SubCategory::findOrFail($id)->delete();
        } catch (Exception $exception) {
            return response(array('code' => 404, 'status' => 'failed', 'message' => $exception->getMessage()), 404, array('Content-Type' => 'application/json'));
        }

        return response(array('code' => 200,
            'status' => 'success',
            'message' => 'Sub Category deleted successfully!',
            'table' => '#subcategory-table'
        ), 200, array('Content-Type' => 'application/json'));
    }

    public function validateSubCategory(Request $request, $id = null): void
    {
        $request->validate([
            'category' => ['required'],
            'name' => ['required',
                'string',
                'max:200',
                Rule::unique('sub_categories', 'name')->ignore($id)],
            'status' => ['required'],
        ]);
    }

    public function getSubcategoriesByCategory(Request $request): Collection
    {
        return SubCategory::where('category_id', $request->category_id)
            ->where('status', 1)
            ->get();
    }

}
