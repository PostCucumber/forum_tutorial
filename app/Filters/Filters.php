<?php

namespace App\Filters;

use Illuminate\HTTP\Request;

abstract class Filters
{
    protected $request, $builder;    

    protected $filters = [];

    public function __construct(Request $request)
    {   
        $this->request = $request;
    }

    public function apply($builder)
    {
        $this->builder = $builder;

        foreach($this->getFilters() as $filter => $value) {
            if (method_exists($this, $filter)) {
                $this->$filter($value);    
            }
        }

        return $this->builder;
    }

    // public function getFilters()
    // {
    //     return $this->request->only($this->filters);
    // }

    public function getFilters()
    {
        $filters = array_intersect(array_keys($this->request->all()), $this->filters); //strips unintended arguments

        return $this->request->only($filters);
    }
}