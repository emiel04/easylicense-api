<?php

namespace App\Modules\Core\Helper;

class LanguageHelper
{
    public static function getSupportedLanguages(): array
    {
        return ['en', 'nl'];
    }
    public static function getLanguageOnly($locale): string
    {
        return strtok(strtok($locale, '_'), '-');
    }
    public static function isSupportedLocale($locale): bool
    {
        return in_array($locale, self::getSupportedLanguages());
    }
}
