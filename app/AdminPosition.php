<?php

namespace App;

enum AdminPosition: string
{
    case Administrator = 'administrator';
    case Principal = 'principal';
    case Owner = 'owner';
}
