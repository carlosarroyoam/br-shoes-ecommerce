<?php

namespace App\Http\Controllers\Categories;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
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

        return view('pages.categories.index', compact('categories'));
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
        return view('pages.categories.show', compact('category'));
    }
}
