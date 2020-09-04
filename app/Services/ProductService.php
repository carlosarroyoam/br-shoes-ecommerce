<?php

namespace App\Services;

use App\Product;
use App\ProductVariant;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ProductService
{
    /**
     * Get a listing of the models.
     *
     * @return Illuminate\Database\Eloquent\Collection
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
        return $product->where('id', $productId)->firstOrFail();
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
            $product_variant = new ProductVariant;

            $product->name = $validated['name'];
            $product->slug = $validated['slug'];
            $product->description = $validated['description'];
            $product->featured = $validated['featured'];
            $product->save();

            $product_variant->price_in_cents = $validated['price_in_cents'];
            $product_variant->is_master = true;
            $product->productVariants()->save($product_variant);
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
            $product_variant = $product->productVariants()->where('is_master', true)->first();

            $product->name = $validated['name'];
            $product->slug = $validated['slug'];
            $product->description = $validated['description'];
            $product->featured = $validated['featured'];

            $product_variant->price_in_cents = $validated['price_in_cents'];

            $product->save();
            $product_variant->save();
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
