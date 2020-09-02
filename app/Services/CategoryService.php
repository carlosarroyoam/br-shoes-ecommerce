<?php

namespace App\Services;

use App\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class CategoryService
{
    /**
     * Get all category.
     *
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function getAll()
    {
        return Category::all();
    }

    /**
     * Get category by id.
     *
     * @param $categoryId
     * @return \App\Category
     */
    public function getById($categoryId)
    {
        return $category->where('id', '=', $categoryId)->firstOrFail();
    }

    /**
     * Update category data
     * Store to DB if there are no errors.
     *
     * @param array $validated
     * @return \App\Category
     */
    public function create(array $validated)
    {
        DB::beginTransaction();

        try {
            $validated['slug'] = Str::slug($validated['name']);

            $category = Category::create($validated);
        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());

            throw new InvalidArgumentException('Unable to update category data');
        }

        DB::commit();

        return $category;
    }

    /**
     * Update category data
     * Store to DB if there are no errors.
     *
     * @param array $validated
     * @param \App\Category $category
     * @return \App\Category
     */
    public function update(array $validated, Category $category)
    {
        DB::beginTransaction();

        try {
            $category->name = $validated['name'];
            $category->slug = Str::slug($validated['name']);
            $category->save();
        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());

            throw new InvalidArgumentException('Unable to update category data');
        }

        DB::commit();

        return $category;
    }

    /**
     * Delete category by id.
     *
     * @param \App\Category $category
     * @return void
     */
    public function delete(Category $category)
    {
        DB::beginTransaction();

        try {
            Category::destroy($category->id);
        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());

            throw new InvalidArgumentException('Unable to delete category data');
        }

        DB::commit();
    }
}
