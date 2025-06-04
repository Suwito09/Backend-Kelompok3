<?php

namespace App\Enums;

enum ItemStatus: string
{
    case PENDING = 'pending';
    case RESOLVED = 'resolved';
    case REJECTED = 'rejected';
}
