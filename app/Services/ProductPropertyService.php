<?php

namespace App\Services;

use App\Models\ProductProperty;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ProductPropertyService
{
    /**
     * Get a listing of the models.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAll()
    {
        return ProductProperty::all();
    }

    /**
     * Get the specified model by its id.
     *
     * @param $productPropertyId
     * @return \App\ProductProperty
     */
    public function getById($productPropertyId)
    {
        return ProductProperty::where('id', $productPropertyId)->firstOrFail();
    }

    /**
     * Create the specified model in storage.
     *
     * @param array $validated
     * @return \App\ProductProperty
     */
    public function create(array $validated)
    {
        DB::beginTransaction();

        try {
            $productProperty = new ProductProperty;
            $productProperty->product_id = $validated['product_id'];
            $productProperty->property_type_id = $validated['property_type_id'];
            $productProperty->value = $validated['value'];
            $productProperty->save();
        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());

            throw new InvalidArgumentException('An exception occurred when trying to insert the model in the database.');
        }

        DB::commit();

        return $productProperty;
    }

    /**
      * Update the specified model in storage.
     *
     * @param array $validated
     * @param \App\ProductProperty $productProperty
     * @return \App\ProductProperty
     */
    public function update(array $validated, ProductProperty $productProperty)
    {
        DB::beginTransaction();

        try {
            $productProperty->product_id = $validated['product_id'];
            $productProperty->property_type_id = $validated['property_type_id'];
            $productProperty->value = $validated['value'];
            $productProperty->save();
        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());

            throw new InvalidArgumentException('An exception occurred when trying to update the model in the database.');
        }

        DB::commit();

        return $productProperty;
    }

    /**
     * Delete the specified model from storage.
     *
     * @param \App\ProductProperty $productProperty
     * @return void
     */
    public function delete(ProductProperty $productProperty)
    {
        DB::beginTransaction();

        try {
            $productProperty->delete();
        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());

            throw new InvalidArgumentException('An exception occurred when trying to delete the model in the database.');
        }

        DB::commit();
    }
}
