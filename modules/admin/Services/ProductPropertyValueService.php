<?php

namespace Modules\Admin\Services;

use App\Models\ProductPropertyValue;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ProductPropertyValueService
{
    /**
     * Get a listing of the models.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAll()
    {
        return ProductPropertyValue::all();
    }

    /**
     * Get the specified model by its id.
     *
     * @param int $productPropertyValueId
     * @return \App\Models\ProductPropertyValue
     */
    public function getById($productPropertyValueId)
    {
        return ProductPropertyValue::where('id', $productPropertyValueId)->firstOrFail();
    }

    /**
     * Create the specified model in storage.
     *
     * @param array $validated
     * @return \App\Models\ProductPropertyValue
     */
    public function create(array $validated)
    {
        DB::beginTransaction();

        try {
            $productPropertyValue = new ProductPropertyValue;
            $productPropertyValue->product_id = $validated['product_id'];
            $productPropertyValue->product_property_id = $validated['product_property_id'];
            $productPropertyValue->value = $validated['value'];
            $productPropertyValue->save();
        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());

            throw new InvalidArgumentException('An exception occurred when trying to insert the model in the database.');
        }

        DB::commit();

        return $productPropertyValue;
    }

    /**
      * Update the specified model in storage.
     *
     * @param array $validated
     * @param \App\Models\ProductPropertyValue $productPropertyValue
     * @return \App\Models\ProductPropertyValue
     */
    public function update(array $validated, ProductPropertyValue $productPropertyValue)
    {
        DB::beginTransaction();

        try {
            $productPropertyValue->value = $validated['value'];
            $productPropertyValue->save();
        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());

            throw new InvalidArgumentException('An exception occurred when trying to update the model in the database.');
        }

        DB::commit();

        return $productPropertyValue;
    }

    /**
     * Delete the specified model from storage.
     *
     * @param \App\Models\ProductPropertyValue $productPropertyValue
     * @return void
     */
    public function delete(ProductPropertyValue $productPropertyValue)
    {
        DB::beginTransaction();

        try {
            $productPropertyValue->delete();
        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());

            throw new InvalidArgumentException('An exception occurred when trying to delete the model in the database.');
        }

        DB::commit();
    }
}
