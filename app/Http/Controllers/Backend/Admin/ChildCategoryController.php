<?php

namespace App\Http\Controllers\Backend\Admin;

use App\DataTables\ChildCategoryDataTable;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\ChildCategory;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class ChildCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(ChildCategoryDataTable $dataTable)
    {
        return $dataTable->render('admin.child-category.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.child-category.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validateSubCategory($request);

        $childCategory = new ChildCategory();
        $childCategory->sub_category_id = $request->input('sub_category');
        $childCategory->name = $request->input('name');
        $childCategory->slug = Str::slug($request->input('name'));
        $childCategory->status = $request->input('status');

        try {
            $childCategory->save();
        }catch (Exception $exception){
            toastr()->error($exception->getMessage());
        }

        toastr()->success('Child Category created successfully!', array(), 'success');
        return redirect()->route('admin.child-category.index');

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
        $categories = Category::all();
        $childCategory = ChildCategory::findOrFail($id);
        return view('admin.child-category.edit', compact('categories' ,'childCategory'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validateSubCategory($request, $id);

        $childCategory = ChildCategory::findOrFail($id);

        $childCategory->sub_category_id = $request->input('sub_category');
        $childCategory->name = $request->input('name');
        $childCategory->slug = Str::slug($request->input('name'));
        $childCategory->status = $request->input('status');

        try {
            $childCategory->save();
        }catch (Exception $exception){
            toastr()->error($exception->getMessage());
        }

        toastr()->success('Child Category updated successfully!', array(), 'success');
        return redirect()->route('admin.child-category.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            ChildCategory::findOrFail($id)->delete();
        } catch (Exception $exception) {
            return response(array('code' => 404, 'status' => 'failed', 'message' => $exception->getMessage()), 404, array('Content-Type' => 'application/json'));
        }

        return response(array('code' => 200,
            'status' => 'success',
            'message' => 'Child Category deleted successfully!',
            'table' => '#childcategory-table'
        ), 200, array('Content-Type' => 'application/json'));
    }

    private function validateSubCategory(Request $request, $id = null): void
    {
        $request->validate([
            'category' => 'required',
            'sub_category' => 'required',
            'name' => ['required', 'string', 'max:255',
                Rule::unique('child_categories', 'name')->ignore($id)
            ],
            'status' => 'required',
        ]);
    }
}
