<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

abstract class QueryFilter
{
    /**
     * Incoming request
     * @var \Illuminate\Http\Request
     */
    protected $request;

    /**
     * QueryBuilder
     * @var \Illuminate\Database\Eloquent\Builder
     */
    protected $builder;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Applying all filter parameters to specified filter
     * @param  \Illuminate\Database\Eloquent\Builder $builder
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function apply(Builder $builder): Builder
    {
        $this->builder = $builder;
        foreach ($this->filters() as $name => $value) {
            if (method_exists($this, $name) && !is_null($value)) {
                call_user_func_array([$this, $name], array_filter([$value]));
            }
        }

        return $this->builder;
    }

    /**
     * Returning request params from request
     * @return array
     */
    public function filters(): array
    {
        return $this->request->all();
    }
}
