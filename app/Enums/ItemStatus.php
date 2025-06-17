<?php

namespace App\Enums;

enum ItemStatus: string
{
    case PENDING = 'pending';
    case RETURNED = 'returned';
    case RESOLVED = 'resolved';
}
