<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;

class Tenant extends Model
{
    use Uuid;

    /**
     * @var bool
     */
    public $incrementing = false;
}
