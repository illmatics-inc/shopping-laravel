<?php

namespace App\Models\Traits;

use Illuminate\Database\Eloquent\Builder;

/**
 * Trait ForwardMatchable
 * @package App\Models\Traits
 */
trait ForwardMatchable
{
    /**
     * @param  Builder  $query
     * @param  string  $column
     * @param  string  $value
     * @return Builder
     */
    public function scopeForwardMatch(Builder $query, string $column, string $value)
    {
        $tableName = (new self)->getTable();
        return $query->where("$tableName.$column", 'LIKE', "$value%");
    }
}
