<?php

namespace App\Enums;

enum LoginMethod: string
{
    case SOCIALAUTH = 'social_authentication';
    case MANUALAUTH = 'manual_authentication';
}
