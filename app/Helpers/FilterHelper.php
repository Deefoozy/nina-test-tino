<?php

namespace App\Helpers;

use Illuminate\Database\Query\Builder;

class FilterHelper
{
    public static function applyFilters(Builder $query, array $filterDefinitions, array $conditions): Builder {
        foreach ($filterDefinitions as $filter) {
            if (!array_key_exists($filter['field'], $conditions)) {
                continue;
            }

            switch ($filter['query']) {
                case 'where like':
                    $query = self::addWhereLike($query, $filter, $conditions[$filter['field']]);
                    break;
                case 'where':
                    $query = self::addWhere($query, $filter, $conditions[$filter['field']]);
                    break;
                default:
                    break;
            }
        }

        return $query;
    }

    public static function addWhereLike(Builder $query, array $filterDefinition, array $condition): Builder {
        if(array_key_exists('value', $condition)) {
            return self::generateWhere($query, $filterDefinition['field'], '%' . $condition['value'] . '%', 'like');
        }

        return $query;
    }

    public static function addWhere(Builder $query, array $filterDefinition, array $condition): Builder {
        if(array_key_exists('value', $condition)) {
            if (!array_key_exists('operator', $condition)) {
                return self::generateWhere($query, $filterDefinition['field'], $condition['value']);
            }

            return self::generateWhere($query, $filterDefinition['field'], $condition['value'], $condition['operator']);
        }

        return $query;
    }

    private static function generateWhere(Builder $query, $field, $value, $operator = '='): Builder {
        return $query->where($field, $operator, $value);
    }
}