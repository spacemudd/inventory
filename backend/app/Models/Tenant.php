<?php

namespace App\Models;

use App\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Model;

class Tenant extends Model
{
    use UuidTrait;

    /**
     * @var bool
     */
    public $incrementing = false;
}
