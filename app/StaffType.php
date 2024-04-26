<?php

namespace App;

use Filament\Support\Contracts\HasLabel;

enum StaffType: string implements HasLabel
{
    case TeachingStaff = 'teaching-staff';
    case NonTeachingStaff = 'non-teaching-staff';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::TeachingStaff => 'Teaching staff',
            self::NonTeachingStaff => 'Non teaching staff',
        };
    }
}
