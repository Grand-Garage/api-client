<?php

namespace Grandgarage\ApiClient\Helpers;

use function strlen;

/**
 * Class ApplicationHelper
 * individual static functions
 *
 * @package App\Helpers
 */
class ApplicationHelper
{

    /**
     * Check if array is empty; detects also empty strings
     *
     * @param array $arr
     * @return bool
     */
    public static function isEmpty(array $arr): bool
    {
        foreach ($arr as $key => $value) {
            if (! strlen($value) || empty($value)) {
                unset($arr[$key]);
            }
        }
        if (! $arr) {
            return true;
        }

        return false;
    }

}
