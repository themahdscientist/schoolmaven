<?php

namespace App\Observers;

use App\Models\Staff;
use Illuminate\Support\Facades\Storage;

class StaffObserver
{
    /**
     * Handle the Staff "created" event.
     */
    public function created(Staff $staff): void
    {
        //
    }

    /**
     * Handle the Staff "updated" event.
     */
    public function updated(Staff $staff): void
    {
        if ($staff->isDirty('qualifications')) {
            foreach ($staff->qualifications as $key => $qualify) {
                Storage::disk('public')->delete($staff->qualifications[$key]);
            }
        }
    }

    /**
     * Handle the Staff "deleted" event.
     */
    public function deleted(Staff $staff): void
    {
        if (! is_null($staff->qualifications)) {
            Storage::disk('public')->delete($staff->qualifications);
        }
    }

    /**
     * Handle the Staff "restored" event.
     */
    public function restored(Staff $staff): void
    {
        //
    }

    /**
     * Handle the Staff "force deleted" event.
     */
    public function forceDeleted(Staff $staff): void
    {
        //
    }
}
