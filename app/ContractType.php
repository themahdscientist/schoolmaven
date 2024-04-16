<?php

namespace App;

enum ContractType: string
{
    case FullTime = 'full-time';
    case PartTime = 'part-time';
    case Contractual = 'contractual';
}
