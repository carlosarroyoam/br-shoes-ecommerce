<?php

namespace App\Http\Controllers\Products;

use App\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\Categories\StoreCategory;
use App\Http\Requests\Categories\UpdateCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->authorizeResource(Category::class, 'category');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        return view('pages.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCategory $request)
    {
        $validated = $request->validated();
        $validated['slug'] = Str::slug($validated['name']);

        Category::create($validated);
    }

    /**
     * Display the specified resource.
     *
     * @param  App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return view('pages.categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategory $request, Category $category)
    {
        $validated = $request->validated();

        $category->name = $validated['name'];
        $category->slug = Str::slug($validated['name']);

        $category->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        Category::destroy($category->id);
    }
}
