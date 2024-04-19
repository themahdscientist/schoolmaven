<?php

namespace App\Observers;

use App\Models\School;
use Illuminate\Support\Facades\Storage;

class SchoolObserver
{
    /**
     * Handle the School "created" event.
     */
    public function created(School $school): void
    {
        //
    }

    /**
     * Handle the School "updated" event.
     */
    public function updated(School $school): void
    {
        if ($school->isDirty('logo')) Storage::disk('public')->delete($school->getOriginal('logo'));
    }

    /**
     * Handle the School "deleted" event.
     */
    public function deleted(School $school): void
    {
        if (!is_null($school->logo)) Storage::disk('public')->delete($school->logo);
    }

    /**
     * Handle the School "restored" event.
     */
    public function restored(School $school): void
    {
        //
    }

    /**
     * Handle the School "force deleted" event.
     */
    public function forceDeleted(School $school): void
    {
        //
    }
}
