<?php

namespace App\Traits;

trait UpdatedByTrait
{
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->updated_by = auth()->id();
        });

        static::updating(function ($model) {
            $model->updated_by = auth()->id();
        });
    }
}