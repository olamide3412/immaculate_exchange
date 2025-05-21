<?php

namespace App\Enums;

enum MatchTypeEnums : string
{
    case Exact = 'exact';
    case Contains = 'contains';
}
