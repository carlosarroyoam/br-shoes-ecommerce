<?php

namespace App\Services;

use App\ProductPropertyType;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ProductPropertyTypeService
{
    /**
     * Get a listing of the models.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAll()
    {
        return ProductPropertyType::all();
    }

    /**
     * Get the specified model by its id.
     *
     * @param $productPropertyTypeId
     * @return \App\ProductPropertyType
     */
    public function getById($productPropertyTypeId)
    {
        return ProductPropertyType::where('id', $productPropertyTypeId)->firstOrFail();
    }

    /**
     * Create the specified model in storage.
     *
     * @param array $validated
     * @return \App\ProductPropertyType
     */
    public function create(array $validated)
    {
        DB::beginTransaction();

        try {
            $productPropertyType = new ProductPropertyType;
            $productPropertyType->name = $validated['name'];
            $productPropertyType->save();
        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());

            throw new InvalidArgumentException('An exception occurred when trying to insert the model in the database.');
        }

        DB::commit();

        return $productPropertyType;
    }

    /**
      * Update the specified model in storage.
     *
     * @param array $validated
     * @param \App\ProductPropertyType $productPropertyType
     * @return \App\ProductPropertyType
     */
    public function update(array $validated, ProductPropertyType $productPropertyType)
    {
        DB::beginTransaction();

        try {
            $productPropertyType->name = $validated['name'];
            $productPropertyType->save();
        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());

            throw new InvalidArgumentException('An exception occurred when trying to update the model in the database.');
        }

        DB::commit();

        return $productPropertyType;
    }

    /**
     * Delete the specified model from storage.
     *
     * @param \App\ProductPropertyType $productPropertyType
     * @return void
     */
    public function delete(ProductPropertyType $productPropertyType)
    {
        DB::beginTransaction();

        try {
            $productPropertyType->delete();
        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());

            throw new InvalidArgumentException('An exception occurred when trying to delete the model in the database.');
        }

        DB::commit();
    }
}
