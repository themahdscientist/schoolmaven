<?php

namespace App;

use Filament\Support\Contracts\HasLabel;

enum Period: string implements HasLabel
{
    case FirstTerm = 'FIRST TERM';
    case SecondTerm = 'SECOND TERM';
    case ThirdTerm = 'THIRD TERM';
    case FirstSemester = 'FIRST SEMESTER';
    case SecondSemester = 'SECOND SEMESTER';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::FirstTerm => 'FIRST TERM',
            self::SecondTerm => 'SECOND TERM',
            self::ThirdTerm => 'THIRD TERM',
            self::FirstSemester => 'FIRST SEMESTER',
            self::SecondSemester => 'SECOND SEMESTER',
        };
    }
}
