<?php
/**
 * @author Shafiq al-Shaar <hello@getshafiq.com>
 *
 */

namespace App\Traits;

use Ramsey\Uuid\Uuid;

trait UuidTrait
{
    /**
     * Boot function from laravel.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->{$model->getKeyName()} = (string) Uuid::uuid4()->toString();
        });
    }
}
