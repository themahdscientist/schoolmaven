<?php

namespace App;

use Filament\Support\Contracts\HasLabel;

enum Session: string implements HasLabel
{
    case TwentyTwentyThreeFour = '2023-2024';
    case TwentyTwentyFourFive = '2024-2025';
    case TwentyTwentyFiveSix = '2025-2026';
    case TwentyTwentySixSeven = '2026-2027';
    case TwentyTwentySevenEight = '2027-2028';
    case TwentyTwentyEightNine = '2028-2029';
    case TwentyTwentyNineThirty = '2029-2030';
    case TwentyThirtyOne = '2030-2031';
    case TwentyThirtyOneTwo = '2031-2032';
    case TwentyThirtyTwoThree = '2032-2033';
    case TwentyThirtyThreeFour = '2033-2034';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::TwentyTwentyThreeFour => '2023-2024',
            self::TwentyTwentyFourFive => '2024-2025',
            self::TwentyTwentyFiveSix => '2025-2026',
            self::TwentyTwentySixSeven => '2026-2027',
            self::TwentyTwentySevenEight => '2027-2028',
            self::TwentyTwentyEightNine => '2028-2029',
            self::TwentyTwentyNineThirty => '2029-2030',
            self::TwentyThirtyOne => '2030-2031',
            self::TwentyThirtyOneTwo => '2031-2032',
            self::TwentyThirtyTwoThree => '2032-2033',
            self::TwentyThirtyThreeFour => '2033-2034',
        };
    }
}
