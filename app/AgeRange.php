<?php

namespace App;

use Filament\Support\Contracts\HasLabel;

enum AgeRange: string implements HasLabel
{
    case Kindergarten = '5-6';
    case Grade01 = '6-7';
    case Grade02 = '7-8';
    case Grade03 = '8-9';
    case Grade04 = '9-10';
    case Grade05 = '10-11';
    case Grade06 = '11-12';
    case Grade07 = '12-13';
    case Grade08 = '13-14';
    case Grade09 = '14-15';
    case Grade10 = '15-16';
    case Grade11 = '16-17';
    case Grade12 = '17-18';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::Kindergarten => 'Kindergarten: 5-6',
            self::Grade01 => 'Grade 1: 6-7',
            self::Grade02 => 'Grade 2: 7-8',
            self::Grade03 => 'Grade 3: 8-9',
            self::Grade04 => 'Grade 4: 9-10',
            self::Grade05 => 'Grade 5: 10-11',
            self::Grade06 => 'Grade 6: 11-12',
            self::Grade07 => 'Grade 7: 12-13',
            self::Grade08 => 'Grade 8: 13-14',
            self::Grade09 => 'Grade 9: 14-15',
            self::Grade10 => 'Grade 10: 15-16',
            self::Grade11 => 'Grade 11: 16-17',
            self::Grade12 => 'Grade 12: 17-18',
        };
    }
}
