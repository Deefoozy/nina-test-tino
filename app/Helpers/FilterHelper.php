<?php

namespace App\Helpers;

use Illuminate\Database\Query\Builder;

class FilterHelper
{
    public static function applyFilters(Builder $query, array $filterDefinition, array $values): Builder {
        return $query;
    }
}