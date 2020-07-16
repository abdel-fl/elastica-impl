<?php

namespace App\Utils;

use App\Interfaces\CriteriaInterface;

/**
 * Class CriteriaHelper
 */
class CriteriaHelper
{
    private const EXCLUDED_KEYS = ['page', 'limit', 'sort'];

    /**
     * Get list of criteria as array excluding given $excludedKeys && Pagination information.
     *
     * If $filterNullValues is TRUE, the method excludes null values.
     *
     * @param CriteriaInterface $criteria
     * @param bool              $filterNullValues
     * @param array             $excludedKeys
     *
     * @return array
     */
    public static function filterCriteria(CriteriaInterface $criteria, bool $filterNullValues = true, array $excludedKeys = []): array
    {
        $excludedKeys = array_merge(self::EXCLUDED_KEYS, $excludedKeys);

        return array_filter(
            $criteria->toArray(),
            function ($value, $key) use ($filterNullValues, $excludedKeys) {
                if (in_array($key, $excludedKeys)) {
                    return false;
                }

                return !$filterNullValues || is_array($value) ? !empty($value) : !is_null($value);
            },
            ARRAY_FILTER_USE_BOTH
        );
    }

    /**
     * Transform a criteria sort parameter formatted like this :
     *
     * key1:desc,key2,key3
     *
     * into an array like that :
     *
     * [
     *   "key1": "desc",
     *   "key2": "asc",
     *   "key3": "asc",
     * ]
     *
     * By default if no direction is provided asc is used
     *
     * @param CriteriaInterface $criteria
     *
     * @return array
     */
    public static function formatSort(CriteriaInterface $criteria): array
    {
        $keyValues = explode(',', $criteria->getSort() ?? '');
        $sortArray = [];

        foreach ($keyValues as $keyValue) {
            if (empty(trim($keyValue))) {
                continue;
            }

            $sortDirection = explode(':', trim($keyValue));
            $direction = 'asc';

            if (1 == count($sortDirection)) {
                $sortArray[$sortDirection[0]] = $direction;
                continue;
            }

            $directionProvided = strtolower($sortDirection[1]);
            $direction = in_array($directionProvided, ['asc', 'desc']) ? $directionProvided : $direction;

            $sortArray[$sortDirection[0]] = $direction;
        }

        return $sortArray;
    }
}
