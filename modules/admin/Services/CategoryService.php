<?php

namespace Modules\Admin\Services;

use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CategoryService
{
    /**
     * Get a listing of the models.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAll()
    {
        return Category::all();
    }

    /**
     * Get the specified model by its id.
     *
     * @param $categoryId
     * @return \App\Category
     */
    public function getById($categoryId)
    {
        return Category::where('id', $categoryId)->firstOrFail();
    }

    /**
     * Create the specified model in storage.
     *
     * @param array $validated
     * @return \App\Category
     */
    public function create(array $validated)
    {
        DB::beginTransaction();

        try {
            $category = new Category;
            $category->name = $validated['name'];
            $category->slug = $validated['slug'];
            $category->save();
        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());

            throw new InvalidArgumentException('An exception occurred when trying to insert the model in the database.');
        }

        DB::commit();

        return $category;
    }

    /**
      * Update the specified model in storage.
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
            $category->slug = $validated['slug'];
            $category->save();
        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());

            throw new InvalidArgumentException('An exception occurred when trying to update the model in the database.');
        }

        DB::commit();

        return $category;
    }

    /**
     * Delete the specified model from storage.
     *
     * @param \App\Category $category
     * @return void
     */
    public function delete(Category $category)
    {
        DB::beginTransaction();

        try {
            $category->delete();
        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());

            throw new InvalidArgumentException('An exception occurred when trying to delete the model in the database.');
        }

        DB::commit();
    }
}
