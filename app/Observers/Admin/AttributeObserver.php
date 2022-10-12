<?php

namespace App\Observers\Admin;

use App\Models\Attribute;

class AttributeObserver
{
    /**
     * Handle the Attribute "created" event.
     *
     * @param  \App\Models\Attribute  $attribute
     * @return void
     */
    public function created(Attribute $attribute)
    {
        //
    }

    /**
     * Handle the Attribute "updated" event.
     *
     * @param  \App\Models\Attribute  $attribute
     * @return void
     */
    public function updated(Attribute $attribute)
    {
        $attribute->childes()->update(['is_active'=>$attribute->is_active]);
        $attribute->categories()->update(['is_active'=>$attribute->is_active]);
//        $attribute->products()->update(['is_active'=>$attribute->is_active]);
    }

    /**
     * Handle the Attribute "deleted" event.
     *
     * @param  \App\Models\Attribute  $attribute
     * @return void
     */
    public function deleted(Attribute $attribute)
    {
        //
    }

    /**
     * Handle the Attribute "restored" event.
     *
     * @param  \App\Models\Attribute  $attribute
     * @return void
     */
    public function restored(Attribute $attribute)
    {
        //
    }

    /**
     * Handle the Attribute "force deleted" event.
     *
     * @param  \App\Models\Attribute $attribute
     * @return void
     */
    public function forceDeleted(Attribute $attribute)
    {
        //
    }
}
