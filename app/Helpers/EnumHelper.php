<?php

namespace App\Helpers;

class EnumHelper
{
    public static function options(array $enums): array
    {
        $result = [];
        //It been used in AppServiceProvider.php to share enums accross all pages
        foreach ($enums as $key => $enumClass) {
            if (enum_exists($enumClass)) {
                $result[$key] = collect($enumClass::cases())->map(fn($case) => [
                    'value' => $case->value,
                    'label' => ucfirst(strtolower($case->name)),
                ]);
            }
        }

        return $result;
    }
}
