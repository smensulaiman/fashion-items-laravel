<?php

namespace App\Http\Controllers\Backend\Admin;

use App\DataTables\CategoryDataTable;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(CategoryDataTable $dataTable)
    {
        return $dataTable->render('admin.category.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {

        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'icon' => ['required', 'string', 'not_in:empty'],
            'name' => ['required', 'string', 'max:255', 'unique:categories,name'],
            'status' => ['required', 'integer'],
        ]);

        $category = new Category();

        try {
            $category->icon = $request->icon;
            $category->name = $request->name;
            $category->slug = Str::slug($request->name);
            $category->status = $request->status;

            $category->save();
        } catch (Exception $exception) {
            toastr()->error($exception->getMessage());
        }

        toastr()->success('Slider created successfully!', array(), 'success');
        return redirect()->route('admin.category.index');
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
        $category = Category::findOrFail($id);

        return view('admin.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        $request->validate([
            'icon' => ['required', 'string', 'not_in:empty'],
            'name' => ['required', 'string', 'max:255', 'unique:categories,name'],
            'status' => ['required', 'integer'],
        ]);

        $category = Category::findOrFail($id);

        try {
            $category->icon = $request->icon;
            $category->name = $request->name;
            $category->slug = Str::slug($request->name);
            $category->status = $request->status;

            $category->save();
        } catch (Exception $exception) {
            toastr()->error($exception->getMessage());
        }

        toastr()->success('Slider created successfully!', array(), 'success');
        return redirect()->route('admin.category.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            Category::findOrFail($id)->delete();
        } catch (Exception $exception) {
            return response(array('code' => 403, 'status' => 'failed', 'message' => $exception->getMessage()), 403, array('Content-Type' => 'application/json'));
        }

        return response(array('code' => 200,
            'status' => 'success',
            'message' => 'Category deleted successfully!',
            'table' =>  '#category-table'
            ), 200, array('Content-Type' => 'application/json'));
    }
}
