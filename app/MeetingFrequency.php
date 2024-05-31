<?php

namespace App;

use Filament\Support\Contracts\HasLabel;

enum MeetingFrequency: string implements HasLabel
{
    case Daily = 'daily';
    case Weekly = 'weekly';
    case BiWeekly = 'bi-weekly';
    case Monthly = 'monthly';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::Daily => 'Daily',
            self::Weekly => 'Weekly',
            self::BiWeekly => 'Bi-weekly',
            self::Monthly => 'Monthly',
        };
    }
}
