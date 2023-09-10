<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\SoftDeletes;

class EnterpriseModule extends Pivot
{
    use HasFactory, SoftDeletes;

    protected $table = 'enterprise_has_modules';
}
