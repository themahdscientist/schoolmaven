<?php

namespace App;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum StudentStatus: string implements HasColor, HasIcon, HasLabel
{
    case Active = 'active';
    case Inactive = 'inactive';
    case Graduated = 'graduated';

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::Active => 'success',
            self::Inactive => 'danger',
            self::Graduated => 'gray',
        };
    }

    public function getIcon(): ?string
    {
        return match ($this) {
            self::Active => 's-check-circle',
            self::Inactive => 's-x-circle',
            self::Graduated => 's-academic-cap',
        };
    }

    public function getLabel(): ?string
    {
        return match ($this) {
            self::Active => 'Active',
            self::Inactive => 'Inactive',
            self::Graduated => 'Graduated',
        };
    }
}
