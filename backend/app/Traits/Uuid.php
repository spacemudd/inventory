<?php
/**
 * @author Shafiq al-Shaar <hello@getshafiq.com>
 *
 */

namespace App\Traits;

trait Uuid
{
    /**
     * Boot function from laravel.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->{$model->getKeyName()} = Uuid::generate()->string;
        });
    }
}
