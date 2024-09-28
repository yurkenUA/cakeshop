<?php

namespace App\Observers;

use App\Models\Images;
use Illuminate\Support\Facades\Storage;

class ImagesObserver
{
    /**
     * Handle the Images "created" event.
     */
    public function created(Images $images): void
    {
        //
    }

    /**
     * Handle the Images "updated" event.
     */
    public function updated(Images $images): void
    {
        //
    }

    /**
     * Handle the Images "deleted" event.
     */
    public function deleted(Images $images): void
    {
        Storage::disk('public')->delete($images->path);
        Storage::disk('public')->delete($images->x1600);
    }

    /**
     * Handle the Images "restored" event.
     */
    public function restored(Images $images): void
    {
        //
    }

    /**
     * Handle the Images "force deleted" event.
     */
    public function forceDeleted(Images $images): void
    {
        //
    }
}
