<?php

namespace App\Models\Traits;

use Illuminate\Database\Eloquent\Builder;

/**
 * Trait Sortable
 * @package App\Models\Traits
 */
trait Sortable
{
    /**
     * @param  Builder  $query
     * @param  string  $column
     * @param  string  $direction
     * @return Builder
     */
    public function scopeSort(Builder $query, string $column, string $direction)
    {
        if (!property_exists($this, 'sortables')) {
            return $query;
        }

        if (!in_array($column, $this->sortables)) {
            return $query;
        }

        return $this->buildSortQuery($query, $column, $direction);
    }

    /**
     * @param  Builder  $query
     * @param  string  $column
     * @param  string  $direction
     * @return Builder
     */
    protected function buildSortQuery(Builder $query, string $column, string $direction)
    {
        return $query->orderBy($column, $direction);
    }
}
