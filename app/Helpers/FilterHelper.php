<?php

namespace App\Helpers;

use Illuminate\Database\Query\Builder;

class FilterHelper
{
    public static function applyFilters(Builder $query, array $filterDefinitions, array $values): Builder {
        foreach ($filterDefinitions as $filter) {
            if (!array_key_exists($filter['field'], $values)) {
                continue;
            }

            switch ($filter['query']) {
                case 'where like':
                    $query = self::addWhereLike($query, $filter, $values[$filter['field']]);
                    break;
                case 'where':
                    $query = self::addWhere($query, $filter, $values[$filter['field']]);
                    break;
                default:
                    break;
            }
        }

        return $query;
    }

    public static function addWhereLike(Builder $query, array $filterDefinition, array $value): Builder {
        return $query;
    }

    public static function addWhere(Builder $query, array $filterDefinition, array $value): Builder {
        return $query;
    }
}