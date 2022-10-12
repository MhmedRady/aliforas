<?php

namespace App\Observers;

use App\Models\Auth\Seller;

class SellerObserver
{
    /**
     * Handle the Seller "created" event.
     *
     * @param  \App\Models\Auth\Seller  $seller
     * @return void
     */
    public function created(Seller $seller)
    {
        //
    }

    /**
     * Handle the Seller "updated" event.
     *
     * @param  \App\Models\Auth\Seller  $seller
     * @return void
     */
    public function updated(Seller $seller)
    {
        $seller->products()->update([
            'is_active' => $seller->is_active
        ]);
        $seller->sellerBranch()->update([
            'is_active' => $seller->is_active
        ]);
    }

    /**
     * Handle the Seller "deleted" event.
     *
     * @param  \App\Models\Auth\Seller  $seller
     * @return void
     */
    public function deleted(Seller $seller)
    {
        //
    }

    /**
     * Handle the Seller "restored" event.
     *
     * @param  \App\Models\Auth\Seller  $seller
     * @return void
     */
    public function restored(Seller $seller)
    {
        //
    }

    /**
     * Handle the Seller "force deleted" event.
     *
     * @param  \App\Models\Auth\Seller  $seller
     * @return void
     */
    public function forceDeleted(Seller $seller)
    {
        //
    }
}
