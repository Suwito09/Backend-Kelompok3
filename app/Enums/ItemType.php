<?php

namespace App\Enums;

enum ItemType: string
{
    case LOST  = 'lost';
    case FOUND = 'found';
}
