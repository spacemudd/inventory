<?php

namespace App\Models;

use App\Scopes\TenantScope;
use Illuminate\Database\Eloquent\Model;

class Proposal extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'client_name',
        'client_number',
        'email',
        'address',
        'phone',
        'cr_number',
        'supervisor_id',
    ];

    /**
     * "Booting" of model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new TenantScope);
    }
}
