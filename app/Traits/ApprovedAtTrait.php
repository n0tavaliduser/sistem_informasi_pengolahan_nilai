<?php

namespace App\Traits;

trait ApprovedAtTrait
{
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->approved_at = now();
        });
    }
}