<?php

namespace App\Models\Traits;

use Illuminate\Database\Eloquent\Builder;

/**
 * Trait FuzzySearchable
 * @package App\Models\Traits
 */
trait FuzzySearchable
{
    /**
     * @param  Builder  $query
     * @param  string  $column
     * @param  string  $value
     * @return Builder
     */
    public function scopeFuzzySearch(Builder $query, string $column, string $value)
    {
        $tableName = (new self)->getTable();
        return $query->where("$tableName.$column", 'LIKE', "%$value%");
    }
}
