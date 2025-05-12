<?php

namespace App\Enums;

enum RoleEnums : string
{
    case User = 'user';
    case Administrator = 'administrator';
    case SuperAdministrator = 'super administrator';
}
