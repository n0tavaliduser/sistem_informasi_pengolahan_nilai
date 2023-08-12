<?php

namespace App\Traits;

trait ApprovedByTrait
{
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->approved_by = auth()->id();
        });
    }
}