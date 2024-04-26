<?php

namespace App;

use Filament\Support\Contracts\HasLabel;

enum PositionTitle: string implements HasLabel
{
    case Mr = 'mr.';
    case Mrs = 'mrs.';
    case Miss = 'miss.';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::Mr => 'Mr.',
            self::Mrs => 'Mrs.',
            self::Miss => 'Miss',
        };
    }
}
