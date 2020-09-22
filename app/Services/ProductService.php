<?php

namespace App\Services;

use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ProductService
{
    /**
     * Get a listing of the models.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAll()
    {
        return Product::all();
    }

    /**
     * Get the specified model by its id.
     *
     * @param $productId
     * @return \App\Product
     */
    public function getById($productId)
    {
        return Product::where('id', $productId)->firstOrFail();
    }

    /**
     * Create the specified model in storage.
     *
     * @param array $validated
     * @return \App\Product
     */
    public function create(array $validated)
    {
        DB::beginTransaction();

        try {
            $product = new Product;

            $product->name = $validated['name'];
            $product->slug = $validated['slug'];
            $product->description = $validated['description'];
            $product->featured = $validated['featured'];
            $product->save();
        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());

            throw new InvalidArgumentException('An exception occurred when trying to insert the model in the database.');
        }

        DB::commit();

        return $product;
    }

    /**
      * Update the specified model in storage.
     *
     * @param array $validated
     * @param \App\Product $product
     * @return \App\Product
     */
    public function update(array $validated, Product $product)
    {
        DB::beginTransaction();

        try {
            $product->name = $validated['name'];
            $product->slug = $validated['slug'];
            $product->description = $validated['description'];
            $product->featured = $validated['featured'];
            $product->save();
        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());

            throw new InvalidArgumentException('An exception occurred when trying to update the model in the database.');
        }

        DB::commit();

        return $product;
    }

    /**
     * Delete the specified model from storage.
     *
     * @param \App\Product $product
     * @return void
     */
    public function delete(Product $product)
    {
        DB::beginTransaction();

        try {
            $product->delete();
        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());

            throw new InvalidArgumentException('An exception occurred when trying to delete the model in the database.');
        }

        DB::commit();
    }
}
