<?php

namespace Modules\Admin\Http\Controllers\Categories;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Modules\Admin\Http\Requests\Categories\CategoryStoreRequest;
use Modules\Admin\Http\Requests\Categories\CategoryUpdateRequest;
use Modules\Admin\Services\CategoryService;

class CategoryController extends Controller
{
    /**
     * The category service instance.
     *
     * @var \App\Services\CategoryService
     */
    protected $categoryService;

    /**
     * Create a new controller instance.
     *
     * @param  \App\Models\Services\CategoryService  $categoryService
     * @return void
     */
    public function __construct(CategoryService $categoryService)
    {
        $this->authorizeResource(Category::class, 'category');
        $this->categoryService = $categoryService;
    }

    /**
     * Display a listing of the resource.
     *
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $categories = $this->categoryService->getAll();

        return view('admin::pages.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('admin::pages.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Models\Http\Requests\Categories\CategoryStoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryStoreRequest $request)
    {
        $category = $this->categoryService->create($request->validated());

        $request->session()->flash('category.id', $category->id);

        return redirect()->route('admin.categories.index');
    }

    /**
     * Display the specified resource.
     *
     * @param \Illuminate\Http\Request $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Category $category)
    {
        // $categoryById = $this->categoryService->getById($category);
        return view('admin::pages.categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Category $category)
    {
        return view('admin::pages.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Models\Http\Requests\Categories\CategoryUpdateRequest  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryUpdateRequest $request, Category $category)
    {
        $updatedCategory = $this->categoryService->update($request->validated(), $category);

        $request->session()->flash('category.id', $updatedCategory->id);

        return redirect()->route('admin.categories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Category $category)
    {
        $this->categoryService->delete($category);

        return redirect()->route('admin.categories.index');
    }
}
