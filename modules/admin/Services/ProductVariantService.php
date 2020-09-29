<?php

namespace Modules\Admin\Services;

use App\Models\ProductVariant;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ProductVariantService
{
    /**
     * Get a listing of the models.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAll()
    {
        return ProductVariant::all();
    }

    /**
     * Get the specified model by its id.
     *
     * @param int $productVariantId
     * @return \App\Models\ProductVariant
     */
    public function getById($productVariantId)
    {
        return ProductVariant::where('id', $productVariantId)->firstOrFail();
    }

    /**
     * Create the specified model in storage.
     *
     * @param array $validated
     * @return \App\Models\ProductVariant
     */
    public function create(array $validated)
    {
        DB::beginTransaction();

        try {
            $productVariant = new ProductVariant;
            $productVariant->product_id = $validated['product_id'];
            $productVariant->price = $validated['price'];
            $productVariant->comparte_at_price = $validated['comparte_at_price'];
            $productVariant->cost_per_item = $validated['cost_per_item'];
            $productVariant->quantity_on_stock = $validated['quantity_on_stock'];
            $productVariant->is_master = $validated['is_master'];
            $productVariant->save();
        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());

            throw new InvalidArgumentException('An exception occurred when trying to insert the model in the database.');
        }

        DB::commit();

        return $productVariant;
    }

    /**
      * Update the specified model in storage.
     *
     * @param array $validated
     * @param \App\Models\ProductVariant $productVariant
     * @return \App\Models\ProductVariant
     */
    public function update(array $validated, ProductVariant $productVariant)
    {
        DB::beginTransaction();

        try {
            $productVariant->price = $validated['price'];
            $productVariant->comparte_at_price = $validated['comparte_at_price'];
            $productVariant->cost_per_item = $validated['cost_per_item'];
            $productVariant->quantity_on_stock = $validated['quantity_on_stock'];
            $productVariant->save();
        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());

            throw new InvalidArgumentException('An exception occurred when trying to update the model in the database.');
        }

        DB::commit();

        return $productVariant;
    }

    /**
     * Delete the specified model from storage.
     *
     * @param \App\Models\ProductVariant $productVariant
     * @return void
     */
    public function delete(ProductVariant $productVariant)
    {
        DB::beginTransaction();

        try {
            $productVariant->delete();
        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());

            throw new InvalidArgumentException('An exception occurred when trying to delete the model in the database.');
        }

        DB::commit();
    }
}
